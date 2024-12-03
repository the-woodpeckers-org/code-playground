<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Chính thức khởi động sân chơi Đường đua lập trình 2024',
                'slug' => 'chinh-thuc-khoi-djong-san-choi-djuong-djua-lap-trinh-2024',
                'body' => <<<HEREA
<p><strong><em>Đường đua lập trình 2024 là sân chơi lập trình quy mô
toàn quốc đầu tiên dành cho học sinh từ lớp 1-9, hoàn toàn miễn phí, kéo
 dài từ tháng 9/2024-04/2025 với thể lệ hấp dẫn.</em></strong></p>





<p>Sân chơi do Hệ thống giáo dục trực tuyến VioEdu và Codelearn (FPT IS)
 tổ chức, nơi các em được cọ xát, học hỏi từ đội ngũ chuyên gia công
nghệ và tự tin khẳng định bộ kỹ năng của công dân thế kỷ 21, đồng thời
chinh phục loạt giải thưởng hấp dẫn của sân chơi với tổng trị giá lên
tới <strong><em>500 triệu đồng.</em></strong></p>





<p>Thể lệ chi tiết về sân chơi như sau:</p>
<p>
<h2 class="wp-block-heading"><span id="i-thong-tin-chung"><strong>I. THÔNG TIN CHUNG</strong></span></h2>



<p><strong>1. Thông tin chung</strong></p>



<p>– Tên sân chơi: Đường đua lập trình 2024</p>



<p>– Đơn vị chỉ đạo: Sở Giáo dục và Đào tạo</p>



<p>– Đơn vị tổ chức và tài trợ giải thưởng: Công ty TNHH FPT IS</p>



<p>– Hình thức tổ chức: Kết hợp thi trực tuyến trên hệ thống <a href="https://codelearn.io" target="_blank" rel="noopener">https://codelearn.io</a> và thi trực tiếp tại từng khu vực ở vòng Chung kết.</p>



<p>– Đối tượng tham gia: Học sinh từ lớp 1 đến lớp 9 trên toàn quốc.</p>



<p>– Chi phí tham gia: Miễn phí.</p>



<p><strong>2. Mục đích</strong></p>



<p>– Nhằm tạo sân chơi bổ ích, lý thú, hiện đại qua đó giúp học sinh
Tiểu học và THCS làm quen với ngôn ngữ lập trình, nâng bậc tư duy, tăng
cường ứng dụng CNTT vào học tập, hoàn thiện bộ kỹ năng của công dân thời
 đại số.</p>



<p>– Mang đến cơ hội cọ xát, giao lưu, học hỏi cho học sinh, đồng thời
góp phần tìm ra các tài năng lập trình nhí, tạo điều kiện để các em khám
 phá khả năng, nuôi dưỡng đam mê của bản thân.</p>



<p>– Góp phần thúc đẩy tiếp cận số, chuyển đổi số trong giáo dục, nâng
cao chất lượng nguồn nhân lực phát triển đất nước trong tương lai.</p>

<h2 class="wp-block-heading"><span id="ii-the-le-san-choi"><strong>II. THỂ LỆ SÂN CHƠI</strong></span></h2>



<h3 class="wp-block-heading"><span id="1-hang-muc-thi-dau"><strong>1. Hạng mục thi đấu</strong></span></h3>



<p>Cuộc thi chia làm 3 hạng mục giải xuyên suốt các vòng thi. Khối học và nội dung thi đấu theo từng hạng mục như sau:</p>



<ul class="wp-block-list">
<li>Hạng mục Lập trình nhí: từ khối 1 đến khối 3, thi ngôn ngữ Scratch;</li>



<li>Hạng mục Lập trình thiếu nhi: từ khối 4 đến khối 5, thi ngôn ngữ Scratch;</li>



<li>Hạng mục Lập trình trẻ: Các khối THCS, học sinh chọn 1 trong 3 ngôn ngữ lập trình Python, C++ hoặc Java.</li>
</ul>



<h3 class="wp-block-heading"><span id="2-cach-thuc-tham-gia"><strong>2. Cách thức tham gia</strong></span></h3>



<p>Học sinh tham gia sân chơi theo các bước sau:</p>



<p><strong>–  Bước 1:</strong> Đăng ký tài khoản trên Codelearn. Nếu đã có tài khoản có thể bỏ qua bước này. Có 2 cách đăng ký tài khoản:</p>



<p><em><u>+ Cách 1:</u></em> Đăng ký tự do. Học sinh đăng ký và kích hoạt tài khoản trên hệ thống <a href="https://codelearn.io" target="_blank" rel="noopener">https://codelearn.io</a></p>



<p><em><u>+ Cách 2:</u></em> Đăng ký qua trường học. Các trường nhập danh sách học sinh đăng ký theo mẫu và gửi về địa chỉ <a href="mailto:support@codelearn.io">support@codelearn.io</a>. Ban tổ chức (BTC) sẽ xác nhận thông tin và cung cấp tài khoản đăng nhập. </p>



<p>Mẫu form đăng ký Đường đua lập trình qua nhà trường: <a href="https://drive.google.com/drive/folders/1FgBvHJPSg8RFsY5-eULmoEwju_HzhJih" target="_blank" rel="noopener">Tài liệu đính kèm</a></p>



<p><strong>– Bước 2:</strong> Cập nhật thông tin cá nhân.</p>



<p>Học sinh sau khi đăng nhập vào đường dẫn <a href="https://codelearn.io/event/duong-dua-lap-trinh" target="_blank" rel="noopener">https://codelearn.io/event/duong-dua-lap-trinh-2024</a>. Bấm nút Cập nhật hồ sơ và điền thông tin đúng với địa chỉ, trường, khối của mình.</p>



<p>Học sinh điền sai thông tin sẽ không vào được đúng cuộc thi theo hạng mục.</p>



<p><strong>– Bước 3:</strong> Khi các vòng thi được mở, học sinh vào đúng hạng mục thi của mình và làm các đề đã mở trong thời gian quy định.</p>



<p>Nếu trong quá trình đăng ký, dự thi có sự cố hoặc cần trợ giúp, vui lòng liên hệ theo thông tin của BTC tại mục V.</p>



<h3 class="wp-block-heading"><span id="3-the-le"><strong>3. Thể lệ</strong></span></h3>



<p>Sân chơi gồm tổng số 03 vòng thi: Khởi động, Tăng tốc và Chung kết.</p>



<p><strong><em>3.1 Vòng </em></strong><strong><em>Khởi động</em></strong></p>



<p>– Hình thức thi: Học sinh tham gia thi trắc nghiệm lý thuyết, trực tuyến trên hệ thống Codelearn.</p>



<p>– Thời gian diễn ra: 0h00 30/09/2024 – 23h59 12/01/2025</p>



<p>– Vòng thi bao gồm 15 thử thách.</p>



<p>– Mỗi thử thách có 20 câu hỏi (mỗi câu trả lời đúng được 01 điểm), thời gian làm bài 15 phút.</p>



<p>– Kết thúc toàn bộ thử thách, các học sinh có tổng điểm đạt 150 điểm trở lên sẽ được tham gia vòng Tăng tốc.</p>



<p><strong><em>*Lưu ý:</em></strong></p>



<p>+ Đối với hạng mục Lập trình trẻ, học sinh phải lựa chọn 1 trong 3
ngôn ngữ lập trình Python, C++ hoặc Java trước khi làm bài lần đầu tiên.
 Học sinh đã chọn ngôn ngữ sẽ không được thay đổi lựa chọn trong suốt
vòng thi đấu.</p>



<p>+ Mỗi tuần hệ thống sẽ mở mới 01 Thử thách, học sinh có thể tham gia
làm bài bất cứ thời điểm nào nhưng chỉ có 01 lượt làm bài duy nhất.</p>



<p>+ Học sinh thuộc hạng mục nào chỉ được tham gia thử thách của hạng mục đó.</p>



<p>+ Bảng xếp hạng của vòng Khởi động sẽ được cập nhật liên tục (luỹ kế)
 và chốt vào 23h59 ngày 12/01/2025, là căn cứ để tính điểm thưởng cho
danh sách 100 học sinh đứng đầu.</p>



<p><strong>– Lịch thi đấu vòng Khởi động:</strong></p>



<figure class="wp-block-image size-large"><img fetchpriority="high" decoding="async" width="855" height="1024" src="https://s3.vio.edu.vn/tintuc/wp-content/uploads/lich-thi-dau-duong-dua-lap-trinh-2024-1-855x1024.jpg" alt="lich-thi-dau-duong-dua-lap-trinh-2024-vioedu" class="wp-image-8813 td-animation-stack-type0-2" title="Chính thức khởi động sân chơi Đường đua lập trình 2024" srcset="https://s3.vio.edu.vn/tintuc/wp-content/uploads/lich-thi-dau-duong-dua-lap-trinh-2024-1-250x300.jpg 250w, https://s3.vio.edu.vn/tintuc/wp-content/uploads/lich-thi-dau-duong-dua-lap-trinh-2024-1-855x1024.jpg 855w, https://s3.vio.edu.vn/tintuc/wp-content/uploads/lich-thi-dau-duong-dua-lap-trinh-2024-1-768x920.jpg 768w, https://s3.vio.edu.vn/tintuc/wp-content/uploads/lich-thi-dau-duong-dua-lap-trinh-2024-1-696x834.jpg 696w, https://s3.vio.edu.vn/tintuc/wp-content/uploads/lich-thi-dau-duong-dua-lap-trinh-2024-1-1068x1280.jpg 1068w, https://s3.vio.edu.vn/tintuc/wp-content/uploads/lich-thi-dau-duong-dua-lap-trinh-2024-1.jpg 1080w" sizes="(max-width: 855px) 100vw, 855px" /></figure>



<p><strong><em>3.2 Vòng </em></strong><strong><em>Tăng tốc</em></strong></p>



<p>– Hình thức: Học sinh thực hành làm bài tập trực truyến trên hệ thống Codelearn.</p>



<p>– Vòng Tăng tốc sẽ bao gồm 2 phần thi: <strong>Chạy đà</strong> và <strong>Bứt phá.</strong></p>



<p>– Các vòng thi sẽ được xếp hạng theo khu vực: Phía Bắc và phía Nam.</p>



<p>– Kết thúc phần thi Bứt phá, BTC sẽ lựa chọn 100 học sinh đứng đầu BXH/hạng mục/khu vực lọt vào Vòng chung kết.</p>
<br /></p>
HEREA,
                'created_by' => 2,
                'thumbnail' => 'https://res.cloudinary.com/ddgnrqr3j/image/upload/v1732649038/chhans7lhjjnlwozf9ow.png'
            ],
            [
                'title' => 'ChatGPT phiên bản mới: Thông minh hơn, miễn phí',
                'slug' => 'chatgpt-phien-ban-moi:-thong-minh-hon-mien-phi',
                'body' => <<<HEREA
<p>
<h2 class="singular-sapo">OpenAI vừa cho ra mắt phiên bản mới của phần
mềm chatbot tích hợp trí tuệ nhân tạo (AI) ChatGPT, với các tính năng
thông minh hơn và cho phép người dùng sử dụng hoàn toàn miễn phí.</h2><div class="singular-content"><p>OpenAI
 vừa cho ra mắt mô hình ngôn ngữ lớn (Large language model - LLM, nền
tảng để phát triển các phần mềm chatbot AI) mới nhất của công ty, mang
tên gọi GPT-4o. Đây là bản cập nhật của mô hình GPT-4 được ra mắt cách
đây hơn một năm.</p><p>Phiên bản ChatGPT miễn phí sẽ được cập nhật lên
mô hình ngôn ngữ GPT-4o mới nhất, nghĩa là người dùng có thể trải nghiệm
 các tính năng mới của GPT-4o hoàn toàn miễn phí.</p><p>Hiện tại, phiên
bản ChatGPT miễn phí sử dụng mô hình ngôn ngữ lớn GPT-3.5, được ra mắt
vào tháng 10/2021 với cơ sở dữ liệu được cập nhật đến tháng 9/2021.</p><p>Với
 việc sử dụng LLM GPT-4o mới nhất, ChatGPT phiên bản miễn phí sẽ được
cập nhật cơ sở dữ liệu mới hơn, giúp trả lời người dùng với những thông
tin và dữ liệu mới nhất.</p><figure class="image align-center" contenteditable="false"><img title="ChatGPT phiên bản mới: Thông minh hơn, miễn phí - 1" src="https://cdnphoto.dantri.com.vn/2bHEb4CzC5R_TWHdhbBTbqgDLbw=/thumb_w/1020/2024/05/14/chatgpt-1715655463352.jpg" alt="ChatGPT phiên bản mới: Thông minh hơn, miễn phí - 1" data-width="1200" data-height="640" data-original="https://cdnphoto.dantri.com.vn/aJtAjKybZ2B2Gp4TEN-_T_mRwtM=/2024/05/14/chatgpt-1715655463352.jpg" data-photo-id="2957858" data-custom-alt="true" data-content-name="article-content-image" data-content-piece="article-content-image_2957858" data-content-target="/suc-manh-so/chatgpt-phien-ban-moi-thong-minh-hon-mien-phi-20240514095919326.htm" data-src="https://cdnphoto.dantri.com.vn/2bHEb4CzC5R_TWHdhbBTbqgDLbw=/thumb_w/1020/2024/05/14/chatgpt-1715655463352.jpg" data-srcset="https://cdnphoto.dantri.com.vn/2bHEb4CzC5R_TWHdhbBTbqgDLbw=/thumb_w/1020/2024/05/14/chatgpt-1715655463352.jpg 1x, https://cdnphoto.dantri.com.vn/BjMD1MYK6RiF-3EmhSghsLt-7uM=/thumb_w/1360/2024/05/14/chatgpt-1715655463352.jpg 2x" data-ll-status="loaded" class="entered loaded" srcset="https://cdnphoto.dantri.com.vn/2bHEb4CzC5R_TWHdhbBTbqgDLbw=/thumb_w/1020/2024/05/14/chatgpt-1715655463352.jpg 1x, https://cdnphoto.dantri.com.vn/BjMD1MYK6RiF-3EmhSghsLt-7uM=/thumb_w/1360/2024/05/14/chatgpt-1715655463352.jpg 2x" /><figcaption><p>Phiên bản miễn phí của ChatGPT sẽ trở nên thông minh và dễ sử dụng hơn nhờ LLM mới được ra mắt (Ảnh minh họa: Getty).</p></figcaption></figure><div id="dta-100000-container" class="dta-unit" style="width: auto !important"></div><p>OpenAI
 cho biết nhờ vào GPT-4o, ChatGPT sẽ trở thành một trợ lý ảo kỹ thuật số
 có thể tương tác và trò chuyện với người dùng bằng giọng nói theo thời
gian thực, nghĩa là người dùng có thể nói chuyện trực tiếp với ChatGPT
để đặt câu hỏi, yêu cầu công việc… thay vì bằng cách gõ văn bản như
trước.</p><p>GPT-4o cũng nhận diện các hình ảnh được người dùng cung cấp
 một cách chính xác hơn. Người dùng cũng có thể chụp ảnh văn bản, biểu
đồ… để yêu cầu GPT-4o nhận diện nội dung có trong đó và phân tích, đánh
giá các dữ liệu dựa vào thông tin có trong hình ảnh được cung cấp.</p><p>OpenAI cho biết ChatGPT phiên bản mới cũng có thể trò chuyện và dịch thuật theo thời gian thực nhiều ngôn ngữ khác nhau.</p><p>OpenAI tự tin tuyên bố GPT-4o sẽ giúp ChatGPT trở nên thông minh, dễ sử dụng và phản hồi người dùng nhanh hơn.</p><p>Mira
 Murati, Giám đốc Công nghệ của OpenAI, cho biết phiên bản cập nhật của
ChatGPT giờ đây còn có khả năng ghi nhớ các nội dung hội thoại với người
 dùng, nghĩa là có thể học hỏi từ những cuộc trò chuyện trước đó với
người dùng để có thể cung cấp thông tin đầy đủ, chính xác hơn.</p><p>"Đây
 là lần đầu tiên chúng tôi thực sự có một bước cải tiến nhảy vọt về mức
độ dễ sử dụng của ChatGPT", Mira Murati cho biết. "Sự tương tác giữa
người dùng và ChatGPT trở nên tự nhiên, dễ dàng hơn trước đây rất
nhiều".</p><p>Mô hình ngôn ngữ GPT-4o mới ra mắt được xem là một nỗ lực
của OpenAI giúp dẫn đầu cuộc đua về trí tuệ nhân tạo đang ngày càng trở
nên khốc liệt, khi nhiều "ông lớn" công nghệ khác cũng đã đặt chân vào
cuộc đua này như Gemini của Google, Llama của Meta…</p><p>"Cảm giác
giống như một trợ lý AI trong phim và tôi vẫn rất bất ngờ vì nó có thật.
 Việc đạt được thời gian phản hồi và khả năng biểu đạt ở cấp độ con
người là một sự thay đổi rất lớn", Sam Altman, CEO của OpenAI, tự hào
"khoe" về khả năng của ChatGPT thế hệ mới được ra mắt của công ty.</p><p>OpenAI
 cho biết sẽ cho ra mắt phiên bản phần mềm của ChatGPT dành cho máy tính
 (bao gồm cả Windows lẫn Mac) được tích hợp mô hình ngôn ngữ lớn GPT-4o
mới nhất. Tuy nhiên, công ty vẫn chưa công bố rõ thời điểm phiên bản
phần mềm ChatGPT dành cho máy tính được ra mắt.</p><p>Trước đó, OpenAI
đã ra mắt phiên bản ứng dụng ChatGPT dành cho smartphone Android và
iPhone mà chưa có phần mềm chuyên biệt dành cho máy tính. Người dùng máy
 tính chỉ có thể sử dụng ChatGPT thông qua giao diện web của công cụ
này.</p><p>OpenAI sẽ tích hợp mô hình ngôn ngữ GPT-4o mới nhất cho phiên
 bản ChatGPT miễn phí trong một vài tháng tới. Hiện người dùng ChatGPT
miễn phí vẫn tiếp tục phải tiếp tục sử dụng mô hình ngôn ngữ GPT-3.5 thế
 hệ cũ trong khi chờ bản cập nhật.</p><p>OpenAI cho biết hiện có hơn 100
 triệu người dùng ChatGPT trên toàn cầu. Tuy nhiên, lượng người dùng
công cụ chatbot này đã bị chững lại khi các công cụ chatbot miễn phí như
 Gemini của Google hay Copilot của Microsoft đang cung cấp những tính
năng hữu ích và thể hiện trí thông minh không thua kém, thậm chí vượt
trội so với ChatGPT.</p></div>
<br /></p>
HEREA,
                'created_by' => 2,
                'thumbnail' => 'https://res.cloudinary.com/ddgnrqr3j/image/upload/v1732649313/vcrgjdnlcdrxxvaap9bc.jpg'
            ],
            [
                'title' => 'Nam sinh viên IT giành quán quân lập trình, được đặc cách tuyển dụng dù chưa tốt nghiệp',
                'slug' => 'nam-sinh-vien-it-gianh-quan-quan-lap-trinh-djuoc-djac-cach-tuyen-dung-du-chua-tot-nghiep',
                'body' => <<<HEREA
<div>
<h2 class="singular-sapo">Tại cuộc thi lập trình VPBank Technology
Hackathon, Đào Xuân Quý đã cùng đồng đội giành quán quân cuộc thi và
nhận được lời mời làm việc dù chưa tốt nghiệp.</h2><div class="singular-content"><p><strong>Hành trình của những quán quân</strong></p><p>Trong
 một ngày lướt mạng xã hội Linkedin, Đào Xuân Quý (sinh viên năm cuối
chuyên ngành Kỹ thuật phần mềm tại Trường ĐH FPT Hà Nội) vô tình thấy
thông tin về cuộc thi VPBank Technology Hackathon. Đây là sân chơi được
tổ chức nhằm tìm ra giải pháp tối ưu vận hành công nghệ của ngân hàng và
 tìm kiếm nhân sự trẻ tài năng trong lĩnh vực công nghệ thông tin.</p></div>
<figcaption><p>Đào Xuân Quý đang theo học Kỹ thuật phần mềm tại Trường ĐH FPT Hà Nội.</p></figcaption><p>Xuân
 Quý sau đó đã liên hệ những người anh em trong câu lạc bộ tại trường
đại học để lập nhóm đăng ký. Nhóm của Quý gồm những thành viên xuất thân
 từ câu lạc bộ Kỹ sư phần mềm Nhật Bản JS Club của Trường ĐH FPT Hà Nội,
 lấy tên là Brotherhood of Deadline.</p><p>Từ bước chọn đề tài, nhóm đã
quyết tâm chọn thử thách khó là "Thiết kế tự động kiến trúc hệ thống".
Thử thách này yêu cầu cả nhóm sử dụng trí tuệ nhân tạo để tự động tạo ra
 mô hình kiến trúc hệ thống, từ đó rút ngắn thời gian cho việc lập trình
 các phần mềm tối ưu vận hành của ngân hàng, nâng cao trải nghiệm khách
hàng và nhân sự.</p><p>Tuy đây là thử thách có độ khó cao nhưng lại là
phần kiến thức cả nhóm khá tự tin. Dưới sự dẫn dắt của nhóm trưởng
Nguyễn Đình Anh và sự thân quen của tất cả các thành viên trong nhóm,
đội thi đã có một hành trình suôn sẻ.</p><figure class="image align-center" contenteditable="false"><img title="Nam sinh viên IT giành quán quân lập trình, được đặc cách tuyển dụng dù chưa tốt nghiệp - 2" src="https://cdnphoto.dantri.com.vn/VozD68iTYHsjUjKM1fZJ8xaHWKQ=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-2-1722240568642.png" alt="Nam sinh viên IT giành quán quân lập trình, được đặc cách tuyển dụng dù chưa tốt nghiệp - 2" data-width="2000" data-height="1500" data-original="https://cdnphoto.dantri.com.vn/BwP-AILkljOlwQvafjFO5S0-uiM=/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-2-1722240568642.png" data-photo-id="3059366" data-content-name="article-content-image" data-content-piece="article-content-image_3059366" data-content-target="/giao-duc/nam-sinh-vien-it-gianh-quan-quan-lap-trinh-duoc-dac-cach-tuyen-dung-du-chua-tot-nghiep-20240729151250529.htm" data-src="https://cdnphoto.dantri.com.vn/VozD68iTYHsjUjKM1fZJ8xaHWKQ=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-2-1722240568642.png" data-srcset="https://cdnphoto.dantri.com.vn/VozD68iTYHsjUjKM1fZJ8xaHWKQ=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-2-1722240568642.png 1x, https://cdnphoto.dantri.com.vn/j0y4SQHUMmuM-DR0bIrTzr0PZyU=/thumb_w/1360/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-2-1722240568642.png 2x" data-ll-status="loaded" class="entered loaded" srcset="https://cdnphoto.dantri.com.vn/VozD68iTYHsjUjKM1fZJ8xaHWKQ=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-2-1722240568642.png 1x, https://cdnphoto.dantri.com.vn/j0y4SQHUMmuM-DR0bIrTzr0PZyU=/thumb_w/1360/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-2-1722240568642.png 2x" /><figcaption><p>Khoảnh khắc chiến thắng vỡ òa trong hạnh phúc của cả nhóm.</p></figcaption></figure><p>Quý
 kể lại: "Đến bán kết thôi là cả nhóm mình đã bảo chắc chắn vô địch rồi,
 cuộc thi này tìm đội nhì hơi khốc liệt. Thế nhưng giây phút công bố
chiến thắng vẫn làm các bạn vỡ òa trong hạnh phúc".</p><p>Với việc giành
 quán quân cuộc thi, Quý đã được đặc cách tuyển dụng vào VPBank dù chưa
tốt nghiệp. Ngay sau khi trở thành quán quân cuộc thi, Quý cũng tiếp tục
 dự thi và trở thành quán quân cuộc thi GenAI Hackathon.</p><p><strong>Từng bước xây dựng sự tự tin khi học lập trình </strong></p><p>Nói
 về hành trình học đại học, Quý chia sẻ: "Thật ra ban đầu khi vào trường
 mình khá tự ti chứ không như bây giờ. Bước vào ngành Công nghệ thông
tin của Trường ĐH FPT, xung quanh mình có rất nhiều bạn cùng lớp giỏi
giang và những môn học khó nhằn. Điều này vừa là áp lực, cũng vừa là
động lực để mình quyết tâm phát triển bản thân".</p><figure class="image align-center" contenteditable="false"><img title="Nam sinh viên IT giành quán quân lập trình, được đặc cách tuyển dụng dù chưa tốt nghiệp - 3" src="https://cdnphoto.dantri.com.vn/E4cRVUi2W0d9vpuMdHp61KNW0Gg=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-3-1722240566986.png" alt="Nam sinh viên IT giành quán quân lập trình, được đặc cách tuyển dụng dù chưa tốt nghiệp - 3" data-width="2000" data-height="1500" data-original="https://cdnphoto.dantri.com.vn/BAqwo6-vr_NV0i_U3nR4r6bGSQw=/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-3-1722240566986.png" data-photo-id="3059364" data-content-name="article-content-image" data-content-piece="article-content-image_3059364" data-content-target="/giao-duc/nam-sinh-vien-it-gianh-quan-quan-lap-trinh-duoc-dac-cach-tuyen-dung-du-chua-tot-nghiep-20240729151250529.htm" data-src="https://cdnphoto.dantri.com.vn/E4cRVUi2W0d9vpuMdHp61KNW0Gg=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-3-1722240566986.png" data-srcset="https://cdnphoto.dantri.com.vn/E4cRVUi2W0d9vpuMdHp61KNW0Gg=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-3-1722240566986.png 1x, https://cdnphoto.dantri.com.vn/29st8x6hc0kRCInI1ptYi1O2Zo4=/thumb_w/1360/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-3-1722240566986.png 2x" data-ll-status="loaded" class="entered loaded" srcset="https://cdnphoto.dantri.com.vn/E4cRVUi2W0d9vpuMdHp61KNW0Gg=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-3-1722240566986.png 1x, https://cdnphoto.dantri.com.vn/29st8x6hc0kRCInI1ptYi1O2Zo4=/thumb_w/1360/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-3-1722240566986.png 2x" /><figcaption><p>Môi trường học tập tại Trường ĐH FPT giúp Quý có không gian và động lực phát triển bản thân cả về chuyên môn và con người.</p></figcaption></figure><p>Với
 Quý, câu lạc bộ Kỹ sư phần mềm Nhật Bản JS Club của Trường ĐH FPT Hà
Nội là bước ngoặt. Tại đây, Quý tham gia những lớp chia sẻ kiến thức lập
 trình miễn phí, được gặp gỡ và gây dựng mối quan hệ với những người anh
 chị, bạn bè có chung đam mê kỹ thuật phần mềm.</p><p>Tại câu lạc bộ,
Quý cũng khám phá ra khả năng tổ chức, quản lý của mình và đảm nhận vai
trò phó chủ nhiệm một kỳ của câu lạc bộ. Những kiến thức và kỹ năng này
giúp cậu bạn tự tin hơn với những dự án trên lớp, khi tham gia các cuộc
thi lập trình và đi phỏng vấn xin việc.</p><figure class="image align-center" contenteditable="false"><img title="Nam sinh viên IT giành quán quân lập trình, được đặc cách tuyển dụng dù chưa tốt nghiệp - 4" src="https://cdnphoto.dantri.com.vn/piGYoUBhR-W_DWA0m6uksXnVBAQ=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-4-1722240568489.png" alt="Nam sinh viên IT giành quán quân lập trình, được đặc cách tuyển dụng dù chưa tốt nghiệp - 4" data-width="2000" data-height="1500" data-original="https://cdnphoto.dantri.com.vn/ZV87-suRoVjq3tX48WJ2enH-17c=/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-4-1722240568489.png" data-photo-id="3059368" data-content-name="article-content-image" data-content-piece="article-content-image_3059368" data-content-target="/giao-duc/nam-sinh-vien-it-gianh-quan-quan-lap-trinh-duoc-dac-cach-tuyen-dung-du-chua-tot-nghiep-20240729151250529.htm" data-src="https://cdnphoto.dantri.com.vn/piGYoUBhR-W_DWA0m6uksXnVBAQ=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-4-1722240568489.png" data-srcset="https://cdnphoto.dantri.com.vn/piGYoUBhR-W_DWA0m6uksXnVBAQ=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-4-1722240568489.png 1x, https://cdnphoto.dantri.com.vn/5J5IL4zTNWDtZw9EIZMpGPR_--Q=/thumb_w/1360/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-4-1722240568489.png 2x" data-ll-status="loaded" class="entered loaded" srcset="https://cdnphoto.dantri.com.vn/piGYoUBhR-W_DWA0m6uksXnVBAQ=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-4-1722240568489.png 1x, https://cdnphoto.dantri.com.vn/5J5IL4zTNWDtZw9EIZMpGPR_--Q=/thumb_w/1360/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-4-1722240568489.png 2x" /><figcaption><p>Xuân Quý là phó ban tổ chức cuộc thi Coding Inspiration 2023 với quy mô toàn miền Bắc.</p></figcaption></figure><p>Hiện
 tại, Quý vừa học những kỳ học cuối tại Trường ĐH FPT, vừa làm việc
chính thức tại ngân hàng. Với lịch học và làm việc căng thẳng, phía
trước Quý còn rất nhiều thử thách, dự định cần hoàn thành. Tuy nhiên,
cậu bạn tràn đầy niềm tin vào sự nỗ lực của bản thân.</p><p>Quý chia sẻ
thêm: "Trong trường có nhiều bạn giỏi, bằng tuổi mình, 20 tuổi đã tốt
nghiệp đi làm, đi học lên cao hơn. Mình lấy làm động lực cố gắng hơn nữa
 chứ không nản vì mình hiểu rằng ai cũng có khả năng riêng, có hành
trình riêng. Mình biết ơn tất cả những trải nghiệm và những mối quan hệ
tốt đẹp có được tại Trường ĐH FPT Hà Nội đã giúp mình có được ngày hôm
nay".</p><figure class="image align-center" contenteditable="false"><img title="Nam sinh viên IT giành quán quân lập trình, được đặc cách tuyển dụng dù chưa tốt nghiệp - 5" src="https://cdnphoto.dantri.com.vn/uhzCduBolDJAPfeLlYLrmTYwgi0=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-5-1722240568646.png" alt="Nam sinh viên IT giành quán quân lập trình, được đặc cách tuyển dụng dù chưa tốt nghiệp - 5" data-width="2000" data-height="1500" data-original="https://cdnphoto.dantri.com.vn/2X0Zh-Tkyt1FZg9ZQFaE7a3p3Gg=/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-5-1722240568646.png" data-photo-id="3059367" data-content-name="article-content-image" data-content-piece="article-content-image_3059367" data-content-target="/giao-duc/nam-sinh-vien-it-gianh-quan-quan-lap-trinh-duoc-dac-cach-tuyen-dung-du-chua-tot-nghiep-20240729151250529.htm" data-src="https://cdnphoto.dantri.com.vn/uhzCduBolDJAPfeLlYLrmTYwgi0=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-5-1722240568646.png" data-srcset="https://cdnphoto.dantri.com.vn/uhzCduBolDJAPfeLlYLrmTYwgi0=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-5-1722240568646.png 1x, https://cdnphoto.dantri.com.vn/gGvTRgJxOy5Yo-W1ucGrJAA5Qxo=/thumb_w/1360/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-5-1722240568646.png 2x" data-ll-status="loaded" class="entered loaded" srcset="https://cdnphoto.dantri.com.vn/uhzCduBolDJAPfeLlYLrmTYwgi0=/thumb_w/1020/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-5-1722240568646.png 1x, https://cdnphoto.dantri.com.vn/gGvTRgJxOy5Yo-W1ucGrJAA5Qxo=/thumb_w/1360/2024/07/29/120-pr-toan-quoc-ts-fptu-2024-anh-5-1722240568646.png 2x" /><figcaption><p>Quý được tiếp thêm tự tin từ sự đồng hành của câu lạc bộ Kỹ sư phần mềm Nhật Bản JS Club của Trường ĐH FPT Hà Nội.</p></figcaption></figure><p>Các
 bạn thí sinh có mong muốn học trong môi trường giàu trải nghiệm và rèn
giũa chuyên môn như Quý có thể đăng ký học công nghệ thông tin tại
Trường ĐH FPT với các chuyên ngành Thiết kế Vi mạch bán dẫn, Công nghệ ô
 tô số, Kỹ thuật Phần mềm, Hệ thống thông tin, Trí tuệ nhân tạo, An toàn
 thông tin, Thiết kế mỹ thuật số.</p>
<br /></div>
HEREA,
                'created_by' => 2,
                'thumbnail' => 'https://res.cloudinary.com/ddgnrqr3j/image/upload/v1732649458/iqmhd0yp1wqew1unzlzm.png'
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
