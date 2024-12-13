<script>
import {HTTP} from "@/http-common.js";

export default {
    name: "IdVerification",
    methods: {
        async upload() {
            let api_key = "SYe4cuLbzfvZW4iEBSlZWg51HFTwRrH2";
            let formData = new FormData();
            let imageFile = document.getElementById('input-file').files[0];
            if (!imageFile) {
                alert('Vui lòng chọn ảnh!')
                return;
            }
            formData.append("image", imageFile);
            formData.append("face", 1);
            await HTTP.post(
                'https://api.fpt.ai/vision/idr/vnm/',
                formData,
                {
                    headers: {
                        'api_key': api_key,
                    },
                }
            ).then((response) => {
                console.log(response);
            }).catch((err) => {
                console.log(err);
            });
            // $.ajax({
            //     url: "https://api.fpt.ai/vision/idr/vnm",
            //     type: "POST",
            //     data: formData,
            //     processData: false, // Prevent jQuery from processing the data
            //     contentType: false, // Prevent jQuery from setting the content type
            //     headers: {
            //         'api_key': api_key
            //     },
            //     success: function(data, status){
            //         // alert("Data: " + JSON.stringify(data) + "\nStatus: " + status);
            //         console.log(data)
            //         var rd = data.data[0]
            //         $('#info').empty()
            //         $('#info').append('<p>MÃ CCCD: ' + '<span class="fw-bold">' + rd.id + '</span>' + '</p>')
            //         $('#info').append('<p>HỌ VÀ TÊN: ' + '<span class="fw-bold">' + rd.name + '</span>' + '</p>')
            //         $('#info').append('<p>NGÀY THÁNG NĂM SINH: ' + '<span class="fw-bold">' + rd.dob + '</br>' + '</p>')
            //         $('#info').append('<p>GIỚI TÍNH: ' + '<span class="fw-bold">' + rd.sex + '</span>' + '</p>')
            //         $('#info').append('<p>QUỐC TỊCH: ' + '<span class="fw-bold">' + rd.nationality + '</br>' + '</p>')
            //         $('#info').append('<p>QUÊ QUÁN: ' + '<span class="fw-bold">' + rd.home + '</span>' + '</p>')
            //         $('#info').append('<p>Đ/C THƯỜNG TRÚ: ' + '<span class="fw-bold">' + rd.address + '</span>' + '</p>')
            //         $('#info').append('<p>NGÀY HẾT HẠN: ' + '<span class="fw-bold">' + rd.doe + '</span>' + '</p>')
            //         $('#info').append('<p>HÌNH ẢNH KHUÔN MẶT: </p>')
            //         $('#info').append('<img width="155" height="187" alt="" src="data:image/png;base64,' + rd.face_base64 + '">')
            //         $('#loading').addClass('d-none')
            //     },
            //     error: function(xhr, status, error){
            //         alert('Ảnh không đủ tiêu chuẩn nhận diện (Mờ, thiếu góc, thiếu thông tin, không phải CCCD Việt Nam,...)')
            //     }
            // });
        }
    }
}
</script>

<template>
    <img id="uploaded-img">
    <input type="file" id="input-file" @change="onchangex(this)">
    <button class="border" @click="upload"> SEND </button>
</template>

<style scoped>

</style>
