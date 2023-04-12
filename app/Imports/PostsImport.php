<?php

namespace App\Imports;

use App\Enums\FileTypesEnum;
use App\Enums\PostStatusEnum;
use App\Models\Company;
use App\Models\File;
use App\Models\Language;
use App\Models\Post;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;

class PostsImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $languages = isset($row['ngon_ngu']) ? $row['ngon_ngu'] : $row['yeu_cau'];
        $companyName = $row['cong_ty'];

        $company = Company::firstOrCreate(
            ['name' => trim($companyName)],
            [
                'name' => trim($companyName),
                'city' => $row['dia_diem'],
                'country' => 'VN',
            ]
        );
        $languagesName = explode(',',  $languages);
        foreach ($languagesName as $key => $name) {
            Language::firstOrCreate([
                'name' => trim($name)
            ]);
        }

        $post = Post::create([
            "job_title" => $languages,
            "city" => $row['dia_diem'],
            "company_id" => $company->id,
            "status" => PostStatusEnum::ADMIN_APPROVED
        ]);

        $file = File::create([
            "post_id" => $post->id,
            "link" => $row['link'],
            "type" => FileTypesEnum::JB,
        ]);
        return $post;
    }

    public function rules(): array
    {
        return [
            'cong_ty' => [
                'required',
                'string',
            ],
            'dia_diem' => [
                'required',
                'string',
            ],
            'ngon_ngu' => [
                'required',
                'string',
            ],
            'link' => [
                'required',
                'string',
            ],
        ];
    }

    // public function sheets(): array
    // {
    //     return [
    //         0 => $this,
    //     ];
    // }
}
