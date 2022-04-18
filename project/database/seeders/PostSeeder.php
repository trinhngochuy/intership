<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('posts')->truncate();
        DB::table('posts')->insert([
            [
                'id' => '1',
                'title' => 'Cặp mẹ con vào quán ăn chỉ gọi duy nhất 2 món, người phục vụ vừa nhìn đơn lập tức báo cảnh sát: Quá nguy hiểm!',
                'description' => 'Đây cũng là việc cha mẹ có thể dạy con để không bị kẻ xấu lợi dụng.',
                'content'=> '',
                'category_id'=> '1',
                'thumbnail' =>'https://cdn.coccoc.com/news_feed/20220405/4751223475297182724.jpg',
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
                'user_id' => 1,
                'view'=> 4350,
                'like'=>2150,
                'slug'=> Str::slug("Cặp mẹ con vào quán ăn chỉ gọi duy nhất 2 món, người phục vụ vừa nhìn đơn lập tức báo cảnh sát: Quá nguy hiểm!")
            ],
            [
                'id' => '2',
                'title' => 'Bộ Công an bắt giam ông Đỗ Anh Dũng - Chủ tịch tập đoàn Tân Hoàng Minh',
                'description' => 'Bộ Công an khởi tố, bắt giam ông Đỗ Anh Dũng - Chủ tịch tập đoàn Tân Hoàng Minh, về tội lừa đảo chiếm đoạt tài sản.',
                'content'=> '',
                'category_id'=> '2',
                'thumbnail' =>'https://cdn.24h.com.vn/upload/2-2022/images/2022-04-05/Bo-Cong-an-bat-giam-ong-do-Anh-Dung---Chu-tich-tap-doan-Tan-Hoang-Minh-tan-hoang-minh_dgbk-1649169534-86-width800height509.jpg',
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
                'view'=> 14350,
                'like'=>8150,
                'user_id' => 1,
                'slug'=> Str::slug('Bộ Công an bắt giam ông Đỗ Anh Dũng - Chủ tịch tập đoàn Tân Hoàng Minh'),
            ],
            [
                'id' => '3',
                'title' => 'EU xem xét cấm nhập khẩu từ Nga, giá than tăng dựng đứng',
                'description' => 'EU đề xuất cấm nhập khẩu than từ Nga cùng loạt biện pháp trừng phạt mới.',
                'content'=> '',
                'category_id'=> '3',
                'thumbnail' =>'https://cafefcdn.com/thumb_w/650/203337114487263232/2022/4/5/photo1649173749932-1649173750156711239021.jpg',
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
                'view'=> 6379,
                'like'=>3333,
            'user_id' => 1,
                'slug'=>Str::slug('EU xem xét cấm nhập khẩu từ Nga, giá than tăng dựng đứng'),
            ],
            [
                'id' => '4',
                'title' => 'Sau dầu thô, châu Âu lại trống đánh xuôi, kèn thổi ngược với kim loại từ Nga',
                'description' => 'Châu Âu lại tranh cãi không dứt về việc có nên cấm vận đối với kim loại từ Nga hay không.',
                'content'=> '',
                'category_id'=> '1',
                'thumbnail' =>'https://cafefcdn.com/thumb_w/650/203337114487263232/2022/4/5/photo1649124554521-16491245546331616845022.jpg',
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
                'user_id' => 1,
                'view'=> 7789,
                'like'=>4000,
                'slug'=>Str::slug('Sau dầu thô, châu Âu lại trống đánh xuôi, kèn thổi ngược với kim loại từ Nga')
            ],
            [
                'id' => '5',
                'title' => 'Giá vàng hôm nay 6/4: Giá vàng lình xình, vàng thất thế',
                'description' => 'Baoquocte.vn. Giá vàng hôm nay 6/4, thêm một lần nữa, tại thị trường trong nước giá vàng SJC chính thức đánh mất ngưỡng 69 triệu đồng/lượng. Cũng chịu chung áp lực đi xuống vì lợi suất trái phiếu Mỹ tăng cao và triển vọng Fed tích cực tăng lãi suất cơ bản, giá vàng thế giới bị giảm sức hấp dẫn.',
                'content'=> '',
                'category_id'=> '2',
                'thumbnail' =>'https://baoquocte.vn/stores/news_dataimages/thanhtruc/042022/06/04/gia-vang-hom-nay-64-gia-vang-linh-xinh-di-xuong.jpg?rt=20220406041300',
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
                'user_id' => 1,
                'view'=> 2000,
                'like'=>150,
                'slug'=>Str::slug('Giá vàng hôm nay 6/4: Giá vàng lình xình, vàng thất thế'),

            ],
            [
                'id' => '6',
                'title' => 'Tên tỉnh nào ở Việt Nam nghe thấy dư dả?',
                'description' => 'Bạn có đủ tinh ý và trả lời được câu hỏi đố chữ này không?',
                'content'=> '',
                'category_id'=> '3',
                'thumbnail' =>'https://i1-vnexpress.vnecdn.net/2022/04/04/Screenshot-895-3266-1649046099.png?w=0&h=0&q=100&dpr=2&fit=crop&s=tE-4qdh6QRgYcnZkR8pLaA',
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
                'user_id' => 1,
                'view'=> 15,
                'like'=>13,
                'slug'=>Str::slug('Tên tỉnh nào ở Việt Nam nghe thấy dư dả?'),
            ],       [
                'id' => '7',
                'title' => 'CHÍNH THỨC CÔNG BỐ PHƯƠNG PHÁP "XÓA SỔ" BỆNH TIỂU ĐƯỜNG',
                'description' => 'Cách trung tâm Thành Phố Hà Giang 18km điều đầu tiên khi chúng tôi đặt chân đến trung tâm điều trị tiểu đường của thầy Lương Xuân Viễn đây chúng tôi bất ngờ vì số lượng lớn bệnh nhân xếp hàng đến đây để thăm khám. Hỏi thăm một số người dân sống cùng khu phố gần phòng khám họ đều khẳng định : "Những thông tin trên hoàn toàn là sự thật, nhưng không ngờ lương y Lương Xuân Viễn thời gian gần đây lại nổi tiếng nhanh đến vậy."Giữa cái nắng tháng 7 như thiêu như đốt nhóm PV báo Y TẾ chúng tôi lên đường tìm về Hà Giang - nơi địa đầu tổ quốc để tìm hiểu sự thật về bài thảo dược giúp hàng ngàn người thành công THOÁT KHỎI căn bệnh tiểu đường  tuýp 2 của lương y Lương Xuân Viễn đang làm dậy sóng giới y học cả trong và ngoài nước thời gian gần đây .',
                'content'=> '',
                'category_id'=> '1',
                'thumbnail' =>'https://w.ladicdn.com/s750x600/5e5f1a68883bd933812ec8e1/luong-y-nguyen-ba-nho-2-20210707034919.jpg',
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
                'user_id' => 1,
                'view'=> 7000,
                'like'=>5000,
                'slug'=>Str::slug('CHÍNH THỨC CÔNG BỐ PHƯƠNG PHÁP "XÓA SỔ" BỆNH TIỂU ĐƯỜNG'),
            ],
            [
                'id' => '8',
                'title' => 'Sửa thuế thu nhập cá nhân, lương 17 triệu đồng/tháng chưa phải nộp thuế',
                'description' => 'Đối với các cá nhân là người lao động bị ảnh hưởng bởi dịch Covid-19 nếu bị mất việc làm, không có thu nhập hoặc thu nhập chưa đến mức phải nộp thuế thì không phải nộp thuế',
                'content'=> '',
                'category_id'=> '1',
                'thumbnail' =>'https://nld.mediacdn.vn/thumb_w/684/291774122806476800/2022/4/6/lumxum-16492083354091194729185.jpg',
                'created_at' => '2000-01-01',
                'updated_at' => '2000-01-01',
                'user_id' => 1,
                'view'=> 4350,
                'like'=>2150,
                'slug'=>Str::slug('Sửa thuế thu nhập cá nhân, lương 17 triệu đồng/tháng chưa phải nộp thuế'),
            ]


        ]);
       DB::statement('SET FOREIGN_KEY_CHECKS = 1');
}
}
