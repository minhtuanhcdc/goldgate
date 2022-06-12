
<table class="table borderless">
    <tr  style="border:none !important">
         <td style="border:none !important" class="w-40 py-0"><img src="{{ public_path('/storage/Logo/Thinprep.jpg') }}"/> </td>
        <td  style="font-family: 'Times New Roman', Times, serif !important; border:none !important" class="col-1 py-0" colspan="4">
            <div class="py-0 text-primary" style="font-size:18px">
                <div class="d-flex flex-column text-center uppercase py-0">
                        <div class="py-0">PHIẾU XÉT NGHIỆM TẾ BÀO</div>
                        <div class="py-0">PAP'S SMEAR - ThinPrep®</div>
                        <div class="py-0">REQUEST FOR COLLECTION OF SPECIMEN</div>
            </div>
        </td>
        <td style="border:none !important" colspan="" class="w-40 py-0"><span>{{$value->thinprep_code}}</span></td>
    </tr>
   <tr style="border:none !important" >
        <td style="border:none !important" class="py-1" colspan="3"><span>Ho ten (Name): </span><span class="font-bold">{{$value->custommer->name}}</span></td>

        <td style="border:none !important" class=" py-1">Tuoi:<span>{{$value->custommer->birthday}}</span></td>
        <td style="border:none !important" colspan="py-1" class="py-0">Para:<span>{{$value->para}}</span></td>

    </tr>
   <tr >
        <td style="border:none !important" class="py-0" colspan="3"><span>Dia chi (Address): </span><span class="font-bold">{{$value->custommer->address}}</span></td>

        <td style="border:none !important" class=" py-0"><span></span></td>
        <td style="border:none !important" colspan="2" class="py-0">So Dien Thoai:<span>{{$value->custommer->phone}}</span></td>

    </tr>
   <tr >
        <td style="border:none !important" class="py-0" colspan="3"><span>Don vi gui(Custommer): </span><span class="font-bold">{{$value->ousent_id}}</span></td>

        <td style="border:none !important" class=" py-0"><span></span></td>
        <td style="border:none !important" colspan="2" class="py-0"><span></span></td>

    </tr>
   <tr >
        <td style="border:none !important" class="py-0" colspan="2"><span>IUD (Intra-Uterine Devices) : </span><span class="font-bold">{{$value->ousent_id}}</span></td>

        <td style="border:none !important" class=" py-0" colspan="2">Nội tiết (Hormone)<span></span></td>
        <td style="border:none !important" colspan="" class="py-0" colspan="2">Xạ (Radiation)<span></span></td>
        <td style="border:none !important" colspan="" class="py-0" colspan="2">Không đạt (Unsatisfactory)<span></span></td>

    </tr>
</table>
<div class="text-center text-danger font-weight-bold">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>
</div>