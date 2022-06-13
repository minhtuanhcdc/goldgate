<div class="container-fluid">
        <table class="table borderless">
            <tbody>
                <tr  style="border:none !important">
                    <td style="border:none !important" class="w-40 py-0"><img src="{{ public_path('/storage/Logo/Thinprep.jpg') }}"/> </td>
                    <td  style="border:none !important" class="col-1 py-0" colspan="4">
                        <div class="d-flex flex-column text-center uppercase py-0">
                            <div class="py-0 font-bold" style="font-size:18px;">PHIẾU XÉT NGHIỆM TẾ BÀO</div>
                            <div class="py-0" style="line-height: 1;font-size:16px">PAP'S SMEAR - ThinPrep®</div>
                            <div class="py-0" style="line-height: 1; font-size:16px">REQUEST FOR COLLECTION OF SPECIMEN</div>
                        </div>
                    </td>
                    <td style="border:none !important" colspan="" class="w-40 py-0"><span>{{$value->thinprep_code}}</span></td>
                </tr>
                <tr style="border:none !important" >
                        <td style="border:none !important" class="py-1" colspan="3"><span>Họ và tên (Name): </span><span class="font-bold">{{$value->custommer->name}}</span></td>

                        <td style="border:none !important" class=" py-1">Tuổi:<span>{{$value->custommer->birthday}}</span></td>
                        <td style="border:none !important" colspan="py-1" class="py-0">Para:<span>{{$value->para}}</span></td>

                    </tr>
                <tr >
                    <td style="border:none !important" class="py-0" colspan="3"><span>Địa chỉ (Address): </span><span class="font-bold">{{$value->custommer->address}}</span></td>
                    <td style="border:none !important" class=" py-0"><span></span></td>
                    <td style="border:none !important" colspan="2" class="py-0">Số điện thoại:<span>{{$value->custommer->phone}}</span></td>

                </tr>
                <tr >
                    <td style="border:none !important" class="py-0" colspan="3"><span>Đơn vị gửi(Custommer): </span><span class="font-bold">{{$value->ousent->name}}</span></td>
                    <td style="border:none !important" class=" py-0"><span></span></td>
                    <td style="border:none !important" colspan="2" class="py-0"><span></span></td>
                </tr>
                <tr >
                    <td style="border:none !important" class="py-0" colspan="2"><span>IUD (Intra-Uterine Devices) : </span><span class="font-bold">{{$value->ousent_id}}</span></td>
                    <td style="border:none !important" class=" py-0" colspan="">Nội tiết (Hormone)<span></span></td>
                    <td style="border:none !important" colspan="" class="py-0" colspan="2">Xạ (Radiation)<span></span></td>
                    <td style="border:none !important" colspan="2" class="py-0" colspan="2">Không đạt (Unsatisfactory)<span></span></td>
                </tr>
                <tr >
                    <td style="border:none !important" class="py-0" colspan="3"><span>Kinh chót (Last Menstrual Period) : </span><span class="font-bold"></span></td>
                    <td style="border:none !important" colspan="3" class="py-0">Ngày gửi (Date sent):<span></span></td>
                </tr>
                <tr >
                    <td style="border:none !important" class="py-0" colspan="3"><span>Chẩn đoán lâm sàng (Clinical diagnose) : </span><span class="font-bold"></span></td>
                    <td style="border:none !important" colspan="3" class="py-0">Bác sỹ chỉ định (Physician):<span class="font-bold">{{$value->doctor->name}}</span></td>
                </tr>
            </tbody>
        </table>
    <div class="text-center text-danger font-weight-thin" style="line-height:1; font-size:16px">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>
        <table>
            <tbody>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="border:none !important" ><span class="font-bold" >Đánh giá lam (Specimen evalueation):</span></td>
                    @foreach ($testElements as $key=>$elm )
                        @if ($elm->element_group ==1)
                            <td colspan="2" class="" style="border:none !important">
                                <div class="float-left" style="float:left">
                                    <span class="">{{$elm->name}}</span><span class="fa fa-envelope"></span>
                                    {{-- <span class="font-bold py-0 ml-0 text-left">
                                     @if($elm->id == 1) <input type="checkbox" style="font-size:16px"  name="name" class="py-0  bg-white font-bold text-black"
                                             placeholder="" value="{{$elm->id??''}}"
                                            checked
                                        >
                                     @endif

                                    </span> --}}
                                </div>
                            </td>
                        @endif

                    @endforeach


                </tr>
            </tbody>
        </table>


</div>
<div style="page-break-before:always;"></div>