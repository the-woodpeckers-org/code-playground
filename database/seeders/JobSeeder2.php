<?php

namespace Database\Seeders;

use App\Models\JobRecruitment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Utils\Constants\Status;

class JobSeeder2 extends Seeder
{
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
                $abbank = User::where('email', '=', 'abbank@gmail.com')->first();

                $Abjob = new JobRecruitment();
                $Abjob->user_id = $abbank->id;
                $Abjob->title = 'Backend Developer (Java, Spring Boot)';
                $Abjob->description = '<div id="JobDescription" class="rounded bg-white p-4 md:px-6 md:py-4"><div class="mb-4 border-b border-gray-200 pb-4 last:mb-0 last:border-0 last:pb-0"><h2 class="mb-2 text-base font-bold text-black">Trách nhiệm công việc</h2><div class="prose max-w-full text-sm text-black lg:text-base"><ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Thực hiện quy hoạch và phát triển Backend cho hệ thống nền tảng và các sản phẩm, dịch vụ ngân hàng số.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Tuân theo các tiêu chuẩn thiết kế, tiêu chuẩn mã nguồn, đảm bảo khả năng kiểm thử, bảo mật và hiệu năng cao cho hệ thống.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Phối hợp với team BA, Frontend, SA,... triển khai dự án đảm bảo các yêu cầu về chất lượng, tiến độ.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Thực hiện Unit Test. Hỗ trợ kiểm thử SIT/UAT, sửa lỗi và nghiệm thu chức năng.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Review code, quản lý merge code, hỗ trợ kỹ thuật và đào tạo các thành viên trong dự án.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Thực hiện tối ưu hóa, cải tiến kiến trúc và mở rộng hệ thống.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Xây dựng tài liệu kỹ thuật, tài liệu hướng dẫn triển khai hệ thống.</span></li>
</ul></div></div><div class="mb-4 border-b border-gray-200 pb-4 last:mb-0 last:border-0 last:pb-0"><h2 class="mb-2 text-base font-bold text-black">Kỹ năng &amp; Chuyên môn</h2><div class="prose max-w-full text-sm text-black lg:text-base"><ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Bằng cấp: Đại học chính quy trở lên trong lĩnh vực Công nghệ thông tin</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Kinh nghiệm: tối thiểu 4 năm kinh nghiệm trong lĩnh vực phát triển phần mềm trong lĩnh vực Tài chính, Ngân hàng, Viễn thông, bất động sản.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Thành thạo lập trình hướng đối tượng với Java. Có kinh nghiệm làm việc với Spring Boot, Spring MVC, Spring Security, Maven, OAuth 2.0, OpenID Connect, SAML</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kinh nghiệm thiết kế và phát triển RESTful API, Web socket.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Hiểu biết về kiến trúc Microservice (MSA), SOA, Event-Driven Architecture (EDA)</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Làm việc tốt với cơ sở dữ liệu SQL/NoSQL</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Nắm vững kiến thức về cấu trúc dữ liệu và giải thuật.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Sử dụng thành thạo các IDE phát triển và công cụ quản lý mã nguồn (Git)</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Hiểu biết về Agile/Scrum</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Hiểu biết và có kinh nghiệm thực tế với Cloud, DevOps, CI/CD, Container, Docker, k8s</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Nhiệt tình, trách nhiệm với công việc</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kỹ năng tư duy chiến lược, phân tích, xây dựng quy trình, sản phẩm công nghệ số</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Kỹ năng phát hiện và phòng ngừa rủi ro trong quy trình, hoạt động liên quan công nghệ số.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Lập kế hoạch và quản lý thời gian hiệu quả</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Kỹ năng giải quyết vấn đề tốt</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Giao tiếp tốt bằng tiếng Anh</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Đặc biệt ưu tiên ứng viên có kinh nghiệm làm việc với nền tảng Backbase.</span></li>
</ul></div></div><div><h2 class="mb-2 text-base font-bold text-black">Phúc lợi dành cho bạn</h2><div class="prose max-w-full text-sm text-black lg:text-base"><div class="pl-0"><div class="prose max-w-full text-sm text-black lg:text-base"><p style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;"><em><strong>Lương và phúc lợi hấp dẫn:</strong></em></span></p>
<ul style="text-align: justify;">
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Mức lương cạnh tranh, phản ánh trực tiếp kỹ năng và kinh nghiệm của ứng viên (chi tiết sẽ được thảo luận trong buổi phỏng vấn).13 ngày nghỉ phép linh</span></li>
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">hoạt, bao gồm ngày sinh nhật và các dịp quan trọng khác.</span></li>
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Bảo hiểm đầy đủ theo luật lao động, cùng với ABBANK CARE - chương trình phúc lợi bổ sung đặc biệt dành cho ABBankers.</span></li>
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Lãi suất vay ưu đãi - Quyền lợi đặc biệt dành cho nhân viên ABBANK.</span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;"><em><strong>Cơ hội phát triển nghề nghiệp hấp dẫn:</strong></em></span></p>
<ul style="text-align: justify;">
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Gia nhập các dự án chuyển đổi quy mô lớn, cộng tác cùng các chuyên gia hàng đầu để áp dụng công nghệ mới nhất trong ngành ngân hàng.</span></li>
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Lộ trình phát triển sự nghiệp rõ ràng, được tạo điều kiện cho cả sự phát triển kỹ thuật và quản lý.</span></li>
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Hỗ trợ đào tạo và chứng chỉ trong lĩnh vực IT, ngân hàng/tài chính.</span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;"><em><strong>Môi trường làm việc năng động:</strong></em></span></p>
<ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Mô hình làm việc linh hoạt, trẻ trung, khuyến khích đổi mới và sáng tạo.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Văn phòng được trang bị hiện đại, kèm theo các thiết bị tiên tiến nhất dành cho nhân viên.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Tổ chức thường xuyên các hoạt động ngoại khóa (team building, hội thảo, và các sự kiện văn nghệ), tạo điều kiện cho nhân viên gắn kết và phát triển.</span></li>
</ul></div></div></div></div></div>';
                $Abjob->location = 'Backend Developer ';
                $Abjob->skill = '["Java","SQL","Spring","Restful API","Spring Boot"]';
                $Abjob->salary = 1200;
                $Abjob->deadline = Carbon::now()->addDays(30);
                $Abjob->status = Status::APPROVED;
                $Abjob->position_number = 2;
                $Abjob->save();

                $Abjob2 = new JobRecruitment();
                $Abjob2->user_id = $abbank->id;
                $Abjob2->title = 'Backend Developer (Java, Python, NodeJS)';
                $Abjob2->description = '<div id="JobDescription" class="rounded bg-white p-4 md:px-6 md:py-4"><div class="mb-4 border-b border-gray-200 pb-4 last:mb-0 last:border-0 last:pb-0"><h2 class="mb-2 text-base font-bold text-black">Trách nhiệm công việc</h2><div class="prose max-w-full text-sm text-black lg:text-base"><ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Lập trình, phát triển các hệ thống, ứng dụng của Ngân hàng.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Tự phát triển hoặc phối hợp cùng các nhà cung cấp phát triển/ triển khai các giải pháp CNTT.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Hỗ trợ trong quá trình kiểm thử (UAT, Performance test, Pen test), thực hiện sửa lỗi (nếu phát sinh).</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Phân tích và xử lý sự cố theo phân công. Đánh giá rủi ro của các phần mềm quan trọng, đề xuất bổ sung các biện pháp kiểm soát để giảm thiểu rủi ro.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Viết tài liệu kỹ thuật, đóng góp xây dựng lộ trình, kế hoạch phát triển và cải tiến các giải pháp phần mềm.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Nghiên cứu, thử nghiệm, triển khai áp dụng các xu hướng công nghệ mới vào việc phát triển: GraphQL, Docker Container (K8s), CICD, EventSourcing, CQRS, NoSQL ...</span></li>
</ul></div></div><div class="mb-4 border-b border-gray-200 pb-4 last:mb-0 last:border-0 last:pb-0"><h2 class="mb-2 text-base font-bold text-black">Kỹ năng &amp; Chuyên môn</h2><div class="prose max-w-full text-sm text-black lg:text-base"><ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Ít nhất 05 năm (Chuyên viên cao cấp) / 07 năm (Chuyên gia) kinh nghiệm ở vị trí Phát triển ứng dụng ngân hàng.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Tốt nghiệp Đại học trở lên chuyên ngành về Khoa học máy tính, Công nghệ thông tin, Toán Tin hoặc các chuyên ngành liên quan.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Thành thạo về Java core Back-End, Python, NodeJS, xử lý tốt Multithread (Xử lý tối thiểu 1000-2000 giao dịch cùng lúc), Multi-processing, cơ chế Hash table, cơ chế xử lý file.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kinh nghiệm về PL/SQL, thành thạo việc thiết kế CSDL trên DB Oracle, MS SQL, PostgreSQL, NoSQL, and MongoDB…</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Kinh nghiệm xây dựng hệ thống micro-services có lượng giao dịch lớn. Có hiểu biết vẽ MQ, Cache...</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Kinh nghiệm xây dựng các ứng dụng trên nền tảng cloud.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Kinh nghiệm với các công nghệ sau: Git, CI/CD, K8s, Docker, Linux.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kiến thức về quy trình triển khai và phát triển phần mềm Waterfall/Agile.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có khả năng nghiên cứu công nghệ mới, học tập nhanh.</span></li>
</ul></div></div><div><h2 class="mb-2 text-base font-bold text-black">Phúc lợi dành cho bạn</h2><div class="prose max-w-full text-sm text-black lg:text-base"><div class="pl-0"><div class="prose max-w-full text-sm text-black lg:text-base"><p style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;"><em><strong>Lương và phúc lợi hấp dẫn:</strong></em></span></p>
<ul style="text-align: justify;">
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Mức lương cạnh tranh, phản ánh trực tiếp kỹ năng và kinh nghiệm của ứng viên (chi tiết sẽ được thảo luận trong buổi phỏng vấn)</span></li>
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">13 ngày nghỉ phép linh hoạt, bao gồm ngày sinh nhật và các dịp quan trọng khác</span></li>
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Bảo hiểm đầy đủ theo luật lao động, cùng với ABBANK CARE - chương trình phúc lợi bổ sung đặc biệt dành cho ABBankers</span></li>
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Lãi suất vay ưu đãi - Quyền lợi đặc biệt dành cho nhân viên ABBANK</span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;"><em><strong>Cơ hội phát triển nghề nghiệp hấp dẫn:</strong></em></span></p>
<ul style="text-align: justify;">
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Gia nhập các dự án chuyển đổi quy mô lớn, cộng tác cùng các chuyên gia hàng đầu để áp dụng công nghệ mới nhất trong ngành ngân hàng</span></li>
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Lộ trình phát triển sự nghiệp rõ ràng, được tạo điều kiện cho cả sự phát triển kỹ thuật và quản lý</span></li>
<li><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Hỗ trợ đào tạo và chứng chỉ trong lĩnh vực IT, ngân hàng/tài chính</span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;"><em><strong>Môi trường làm việc năng động:</strong></em></span></p>
<ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Mô hình làm việc linh hoạt, trẻ trung, khuyến khích đổi mới và sáng tạo</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Văn phòng được trang bị hiện đại, kèm theo các thiết bị tiên tiến nhất dành cho nhân viên</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Tổ chức thường xuyên các hoạt động ngoại khóa (team building, hội thảo, và các sự kiện văn nghệ), tạo điều kiện cho nhân viên gắn kết và phát triển</span></li>
</ul></div></div></div></div></div>';
                $Abjob2->location = 'Backend Developer ';
                $Abjob2->skill = '["Java","Python","NodeJS","MongoDB","PostgreSql"]';
                $Abjob2->salary = 1500;
                $Abjob2->deadline = Carbon::now()->addDays(30);
                $Abjob2->status = Status::APPROVED;
                $Abjob2->position_number = 2;
                $Abjob2->save();


                $WooriBankCompany = User::where('email', '=', 'WooriBank@gmail.com')->first();

                $worriJob = new JobRecruitment();
                $worriJob->user_id = $WooriBankCompany->id;
                $worriJob->title = 'Developer C, C++';
                $worriJob->description = '<div id="JobDescription" class="rounded bg-white p-4 md:px-6 md:py-4"><div class="mb-4 border-b border-gray-200 pb-4 last:mb-0 last:border-0 last:pb-0"><h2 class="mb-2 text-base font-bold text-black">Trách nhiệm công việc</h2><div class="prose max-w-full text-sm text-black lg:text-base"><ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif;">Developing and maintaining Securities Depository System using C/C++.</span></span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif;">Supporting other projects related to C/C++</span></span></li>
</ul></div></div><div class="mb-4 border-b border-gray-200 pb-4 last:mb-0 last:border-0 last:pb-0"><h2 class="mb-2 text-base font-bold text-black">Kỹ năng &amp; Chuyên môn</h2><div class="prose max-w-full text-sm text-black lg:text-base"><ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Having 2 year-experience or more working with C,C++</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Having experience about developing website, webapp, etc.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Having knowledge about SQL querying and database</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Having knowledge about java core, java spring, java ee is a plus.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Having experience about stocks or worked with stocks projects, securities custody, etc is a plus.</span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;"><strong>Requirements</strong></span></p>
<ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Age range: 23 ~30</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Gender: No reference</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Starting date: As soon as possible</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Qualification: Graduated from Universities.</span></li>
<li style="text-align: justify;"><span style="color: #212529; font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Other requirements: Good skill in English</span></li>
</ul>
<p><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;"><strong>Working place:</strong>&nbsp;33F Keangnam 72 Tower, Phạm Hùng, Mễ Trì, Nam Từ Liêm, Hà Nội</span></p></div></div><div><h2 class="mb-2 text-base font-bold text-black">Phúc lợi dành cho bạn</h2><div class="prose max-w-full text-sm text-black lg:text-base"><div class="pl-0"><div class="prose max-w-full text-sm text-black lg:text-base"><p>Salary increase annually, promotion review twice per year<br>Annual Healthcare check; Social Insurance as Vietnamese regulation; PTI Insurance<br>Training Opportunities in Korea for outstanding Employees and Internal Training<br>Annual Company Trip<br>12 days annual as Vietnamese regulations<br>Monthly Transportation Allowance<br>Mon - Fri (Morning: 8:30- 12:00, Afternoon: 13:00 - 17:30)</p></div></div></div></div></div>';
                $worriJob->location = 'Developer C, C++';
                $worriJob->skill = '["C","C++","SQL","Java","Spring"]';
                $worriJob->salary = 0;
                $worriJob->position_number = 2;
                $worriJob->negotiable = true;
                $worriJob->deadline = Carbon::now()->addDays(30);
                $worriJob->status = Status::APPROVED;
                $worriJob->save();

                $thanksLab = User::where('email', '=', 'thankslab@gmail.com')->first();
                $thanksJob = new JobRecruitment();
                $thanksJob->user_id = $thanksLab->id;
                $thanksJob->title = '3D Modeler';
                $thanksJob->location = '3D Modeler';
                $thanksJob->description = '<div id="JobDescription" class="rounded bg-white p-4 md:px-6 md:py-4"><div class="prose mb-4 max-w-full border-b border-gray-200 pb-2 text-sm last:mb-0 last:border-0 last:pb-0 lg:text-base"><p style="text-align: justify;"><strong><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">CẦN TUYỂN GẤP&nbsp;</span></strong></p>
<ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Ưu tiên ứng viên có thể phỏng vấn sớm và làm việc ngay</span></li>
</ul></div><div class="mb-4 border-b border-gray-200 pb-4 last:mb-0 last:border-0 last:pb-0"><h2 class="mb-2 text-base font-bold text-black">Trách nhiệm công việc</h2><div class="prose max-w-full text-sm text-black lg:text-base"><ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Tạo mô hình 3D cho nhân vật và trang phục, làm texture 2D và set up skin.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Tạo mô hình 3D cho Background Map và Background Props, làm texture 2D.</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Thực hiện các yêu cầu công việc khác theo chỉ thị của cấp trên.</span></li>
</ul></div></div><div class="mb-4 border-b border-gray-200 pb-4 last:mb-0 last:border-0 last:pb-0"><h2 class="mb-2 text-base font-bold text-black">Kỹ năng &amp; Chuyên môn</h2><div class="prose max-w-full text-sm text-black lg:text-base"><ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có tối thiểu 1 năm kinh nghiệm</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kinh nghiệm thực tế trong việc tạo mô hình nhân vật, background để phát triển mobile game, PC game, PS/XBOX game…</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Thành thạo Maya (có thể làm việc bằng 3D Max nhưng dữ liệu cuối cùng sẽ làm bằng Maya)</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kinh nghiệm thực tế sử dụng Photoshop</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kinh nghiệm thực tế sử dụng Zbrush</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kinh nghiệm thực tế Hand painting hoặc Real style</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có thể đọc hiểu tài liệu đặc tả kỹ thuật và có kinh nghiệm thực tế điều chỉnh dữ liệu 3D khi cần thiết</span></li>
</ul>
<p style="text-align: justify;"><strong><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Ưu tiên:</span></strong></p>
<ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kinh nghiệm sử dụng Substance Painter</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kinh nghiệm sử dụng Unity, Unreal Engine</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kinh nghiệm tạo mô hình 3D high-polygon cho nhân vật, Background Props</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kinh nghiệm chuyển đổi dữ liệu từ high-polygon sang low-polygon</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Có kiến thức về các Scripts như Mel, Python, MAXScript, JavaScript</span></li>
</ul>
<p style="text-align: justify;"><strong><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Hướng đến ứng viên có thể:</span></strong></p>
<ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Chủ động giao tiếp, đề xuất, thảo luận trong Team</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Thích thú với việc giải quyết khó khăn, vấn đề trong công việc</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Nỗ lực không ngừng để nâng cao chất lượng</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Hoàn thành công việc có trách nhiệm</span></li>
</ul>
<p style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;"><strong>Note:</strong> </span></p>
<ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">CHỈ NHẬN CV VÀ PORTFOLIO BẰNG TIẾNG ANH</span></li>
</ul></div></div><div><h2 class="mb-2 text-base font-bold text-black">Phúc lợi dành cho bạn</h2><div class="prose max-w-full text-sm text-black lg:text-base"><div class="pl-0"><div class="prose max-w-full text-sm text-black lg:text-base"><ul>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Thưởng tháng thứ 13</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Thưởng nhân viên chuyên cần mỗi tháng</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Thưởng nhân viên đạt hiệu suất tốt mỗi quý</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Tiền mừng sinh nhật, mừng cưới, mừng sinh em bé...</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Tổ chức Event, Party, quà mừng v.v vào các dịp lễ</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Quầy Pantry với đồ ăn nhẹ phong phú. Đặc biệt Happy Friday mỗi tuần</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Review lương định kỳ mỗi năm</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Môi trường làm việc chuyên nghiệp, cởi mở, hòa đồng và thân thiện</span></li>
<li style="text-align: justify;"><span style="font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;">Khám sức khỏe định kỳ mỗi năm tại bệnh viện của Nhật (có giảm giá khám cho gia đình của nhân viên)</span></li>
</ul></div></div></div></div></div>';
                $thanksJob->skill = '["Game","Maya","3D Modelling"]';
                $thanksJob->salary = 1200;
                $thanksJob->deadline = Carbon::now()->addDays(30);
                $thanksJob->status = Status::APPROVED;
                $thanksJob->position_number = 2;
                $thanksJob->save();


        }
}
