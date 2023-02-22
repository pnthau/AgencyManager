# Phân tích trang mô giới việc làm
##  

[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)](https://nodesource.com/products/nsolid)
## Đối tượng sữ dụng
- Admin
- HR
- Ứng Viên
## Chức năng đối tượng

a. Quản trị viên
- 	Quản lý thông tin : banner, giới thiệu
- 	Quản lý người dùng
-	Quản lý file job, cv
-   Quản lý bài đăng công việc
-   Quản lý báo cáo

b. Nhà tuyển dụng
-	Nhập thông tin tuyển dụng và file job
-	Tìm kiếm cv

c. Ứng viên
-	Tìm kiếm công việc(công ty, vị trí, mức lương, địa điểm, ngôn ngữ, trình độ, remote , partime, yêu cầu chứng chỉ-bằng cấp, số lượng)
-	Đăng CV
-	Xem danh sách công việc (sắp xếp ngẫu nhiên)
-	Báo cáo vi phạm: công ty, cá nhân

## Phân tích chức năng
| Các tác nhân | Nhà tuyển dụng |
| ------ | ------ |
| Mô tả | Đăng bài tuyển dụng |
| GitHub | Người dùng ấn vào nút “Đăng bài Tuyển dụng” trên menu |
| Google Drive | Tên công ty <br> Địa điểm : thành phố- quận<br>Remote<br>Partime<br>Ngôn ngữ<br>Yêu cầu thêm<br>Thời gian hủy bài<br>File Job|
| Trình tự xữ lý | [plugins/onedrive/README.md][PlOd] |
| Đầu ra | Đúng: hiện thị người dùng và thông báo thành công <br>Sai:Hiển thị trang đăng nhập và thông báo thất bại |
| Lưu ý | Validate đăng nhập front end(js) |
