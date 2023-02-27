# Những thứ cần gi nhớ

## đặt tên migration

-create_tableName_table

## Thêm column cho một table

-alter_add_column(s)\_tableName

## Code alter column in table

```php
public function up()
    {
        //
        if (!Schema::hasColumn('posts', 'is_pinned')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->boolean('is_pinned')->default(false)->after('status');
            });
        }
    }


public function down()
    {
        //
        if (!Schema::hasColumn('posts', 'is_pinned')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn(['is_pinned']);
            });
        }
    }

```
