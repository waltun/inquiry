<x-layout>

    <x-slot name="js">
        <script>
            //constants
            let gam_dar_radif = parseFloat(document.getElementById("gamDarRadif").value);
            let gam_dar_ertefa = parseFloat(document.getElementById("gamDarErtefa").value);
            let toole_header = parseFloat(document.getElementById("tooleHeader").value);
            let shire_havagiri = parseFloat(document.getElementById("shireHavagiri").value);
            let picho_mohre = parseFloat(document.getElementById("pichoMohre").value);
            let baste_bandi = parseFloat(document.getElementById("basteBandi").value);
            let roghane_tabkhir_shavande = parseFloat(document.getElementById("roghaneTabkhirShavande").value);
            let abe_shostoshoo = parseFloat(document.getElementById("abeShostoshoo").value);
            let gaze_kapsool = parseFloat(document.getElementById("gazeKapsool").value);
            let connection_berenji_fancoil = parseFloat(document.getElementById("connectionBerenjiFancoil").value);
            let tedade_soorakhe_pakhsh = parseFloat(document.getElementById("tedadeSoorakhePakhsh").value);

            //values section
            let meghdarLoole58Section = document.getElementById("meghdarLoole58");
            let tedadUSection = document.getElementById("tedadU");
            let vaznFinAlSection = document.getElementById("vaznFinAl");
            let vaznFinCuSection = document.getElementById("vaznFinCu");
            let vaznFinBlueSection = document.getElementById("vaznFinBlue");
            let ertefaFinSection = document.getElementById("ertefaFin");
            let tedadMadarSection = document.getElementById("tedadMadar");
            let tooleVaraghSheetSection = document.getElementById("tooleVaraghSheet");
            let arzVaraghSheetSection = document.getElementById("arzVaraghSheet");
            let masahatSheetSection = document.getElementById("masahatSheet");
            let toolVaraghFrameSection = document.getElementById("toolVaraghFrame");
            let arzVaraghFrameSection = document.getElementById("arzVaraghFrame");
            let masahatFrameBalaPayinSection = document.getElementById("masahatFrameBalaPayin");
            let vaznVaraghMasrafiSection = document.getElementById("vaznVaraghMasrafi");
            let toolCollectorSection = document.getElementById("toolCollector");
            let vaznNoghreMasrafiSection = document.getElementById("vaznNoghreMasrafi");
            let vaznBerenjMasrafiSection = document.getElementById("vaznBerenjMasrafi");
            let ozotMasrafiSection = document.getElementById("ozotMasrafi");
            let oxygenMasrafiSection = document.getElementById("oxygenMasrafi");
            let flaksMayeMasrafiSection = document.getElementById("flaksMayeMasrafi");
            let poosheshZedeKhordegiSection = document.getElementById("poosheshZedeKhordegi");
            let tinerSection = document.getElementById("tiner");
            let tedadFineMasrafiSection = document.getElementById("tedadFineMasrafi");
            let looleMessiPakhshKonSection = document.getElementById("looleMessiPakhshKon");

            function calculate() {
                //inputs
                //let zekhamat_loole = parseInt(document.getElementById("zekhamatLoole").value);
                let zekhamat_fin = parseFloat(document.getElementById("zekhamatFin").value);
                let tedad_radif = parseFloat(document.getElementById("tedadRadif").value);
                let fin_dar_inch = parseFloat(document.getElementById("finDarInch").value);
                let toole_fine_khorde = parseFloat(document.getElementById("tooleFineKhorde").value);
                let tedad_loole_dar_yek_radif = parseFloat(document.getElementById("tedadLooleDarYekRadif").value);
                let zekhamat_tioop_sheet_frame = parseFloat(document.getElementById("zekhamatTioopSheetFrame").value);
                //let soozan_volv = parseInt(document.getElementById("soozanVolv").value);

                //values inputs
                let meghdar_loole_58;
                let tedad_u;
                let vazn_fin_al;
                let vazn_fin_cu;
                let vazn_fin_blue;
                let ertefa_fin;
                let tedad_madar;
                let toole_varagh_sheet;
                let arz_varagh_sheet;
                let masahat_sheet;
                let tool_varagh_frame;
                let arz_varagh_frame;
                let masahat_frame_bala_payin;
                let vazn_varagh_masrafi;
                let tool_collector;
                let vazn_noghre_masrafi;
                let vazn_berenj_masrafi;
                let ozot_masrafi = parseInt(document.getElementById("ozot_masrafi").value);
                let oxygen_masrafi = parseInt(document.getElementById("oxygen_masrafi").value);
                let flaks_maye_masrafi;
                let pooshesh_zede_khordegi;
                let tiner;
                let tedad_fine_masrafi;
                let loole_messi_pakhsh_kon;

                //formulas
                tedad_fine_masrafi = (toole_fine_khorde / 25.4) * fin_dar_inch + 10;
                ertefa_fin = tedad_loole_dar_yek_radif * 37.5;
                tedad_madar = tedad_loole_dar_yek_radif;
                toole_varagh_sheet = ertefa_fin + 70;
                arz_varagh_sheet = (tedad_radif * gam_dar_radif) + 130;
                masahat_sheet = toole_varagh_sheet * arz_varagh_sheet / 1000000;
                tool_varagh_frame = toole_fine_khorde + 70;
                arz_varagh_frame = (tedad_radif * gam_dar_radif) + 130;
                meghdar_loole_58 = (toole_fine_khorde + 100) / 1000 * tedad_radif * tedad_loole_dar_yek_radif * 0.217;
                tedad_u = (tedad_radif * tedad_loole_dar_yek_radif) - tedad_madar;
                vazn_fin_al = ((ertefa_fin * (gam_dar_radif * tedad_radif) * zekhamat_fin) * 2.7 * tedad_fine_masrafi) / 1000000;
                vazn_fin_cu = ((ertefa_fin * (gam_dar_radif * tedad_radif) * zekhamat_fin) * 9.78 * tedad_fine_masrafi) / 1000000;
                vazn_fin_blue = ((ertefa_fin * (gam_dar_radif * tedad_radif) * zekhamat_fin) * 2.7 * tedad_fine_masrafi) / 1000000;
                masahat_frame_bala_payin = tool_varagh_frame * arz_varagh_frame / 1000000;
                vazn_varagh_masrafi = (((masahat_frame_bala_payin) + (masahat_sheet)) * zekhamat_tioop_sheet_frame * 7.8 * 2);
                tool_collector = tedad_loole_dar_yek_radif * gam_dar_ertefa * 2;
                toole_header = 150 * 2;
                vazn_noghre_masrafi = (2.7 * tedad_loole_dar_yek_radif * tedad_radif * 2) / 1000;
                vazn_berenj_masrafi = ((tedad_madar * 2) * 4.2) / 1000;
                flaks_maye_masrafi = ((tedad_radif * tedad_loole_dar_yek_radif * 2) + (tedad_madar * 2)) * 0.002;
                pooshesh_zede_khordegi = ((ertefa_fin * toole_fine_khorde / 1000000) * tedad_radif) * 0.2;
                tiner = pooshesh_zede_khordegi * 2;
                tedade_soorakhe_pakhsh = tedad_loole_dar_yek_radif;
                loole_messi_pakhsh_kon = tedade_soorakhe_pakhsh * 0.8 * 74 / 1000;

                //fill values section
                meghdarLoole58Section.innerText = meghdar_loole_58.toFixed(4);
                tedadUSection.innerText = tedad_u.toFixed(4);
                vaznFinAlSection.innerText = vazn_fin_al.toFixed(4);
                vaznFinCuSection.innerText = vazn_fin_cu.toFixed(4);
                vaznFinBlueSection.innerText = vazn_fin_blue.toFixed(4);
                ertefaFinSection.innerText = ertefa_fin.toFixed(4);
                tedadMadarSection.innerText = tedad_madar.toFixed(4);
                tooleVaraghSheetSection.innerText = toole_varagh_sheet.toFixed(4);
                arzVaraghSheetSection.innerText = arz_varagh_sheet.toFixed(4);
                masahatSheetSection.innerText = masahat_sheet.toFixed(4);
                toolVaraghFrameSection.innerText = tool_varagh_frame.toFixed(4);
                arzVaraghFrameSection.innerText = arz_varagh_frame.toFixed(4);
                masahatFrameBalaPayinSection.innerText = masahat_frame_bala_payin.toFixed(4);
                vaznVaraghMasrafiSection.innerText = vazn_varagh_masrafi.toFixed(4);
                toolCollectorSection.innerText = tool_collector.toFixed(4);
                vaznNoghreMasrafiSection.innerText = vazn_noghre_masrafi.toFixed(4);
                vaznBerenjMasrafiSection.innerText = vazn_berenj_masrafi.toFixed(4);
                ozotMasrafiSection.innerText = ozot_masrafi.toFixed(4);
                oxygenMasrafiSection.innerText = oxygen_masrafi.toFixed(4);
                flaksMayeMasrafiSection.innerText = flaks_maye_masrafi.toFixed(4);
                poosheshZedeKhordegiSection.innerText = pooshesh_zede_khordegi.toFixed(4);
                tinerSection.innerText = tiner.toFixed(4);
                tedadFineMasrafiSection.innerText = tedad_fine_masrafi.toFixed(4);
                looleMessiPakhshKonSection.innerText = loole_messi_pakhsh_kon.toFixed(4);
            }
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center text-xs md:text-sm text-gray-500 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    داشبورد
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        محاسبه قیمت کویل
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Content -->
    <form method="POST" action="" class="mt-4">
        @csrf

        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
            <table class="border-collapse border border-gray-400 w-full">
                <thead class="sticky top-1 bg-gray-200 z-50 shadow-md">
                <tr>
                    <th class="border border-gray-300 p-4 text-sm">ردیف</th>
                    <th class="border border-gray-300 p-4 text-sm">شرح</th>
                    <th class="border border-gray-300 p-4 text-sm">مقدار / سایز</th>
                    <th class="border border-gray-300 p-4 text-sm">واحد</th>
                    <th class="border border-gray-300 p-4 text-sm">قیمت واحد</th>
                    <th class="border border-gray-300 p-4 text-sm">قیمت کل</th>
                </tr>
                </thead>
                <tbody>

                <!-- Changeable values -->
                <tr class="bg-yellow-200">
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        1
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        ضخامت لوله
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        <input type="text" name="zekhamat_loole" id="zekhamatLoole" class="input-text" value="0"
                               onkeyup="calculate()">
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        MM
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                </tr>
                <tr class="bg-yellow-200">
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        2
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        ضخامت فین
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        <input type="text" name="zekhamat_fin" id="zekhamatFin" class="input-text" value="0"
                               onkeyup="calculate()">
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        MM
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                </tr>
                <tr class="bg-yellow-200">
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        3
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        تعداد ردیف
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        <input type="text" name="tedad_radif" id="tedadRadif" class="input-text" value="0"
                               onkeyup="calculate()">
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        عدد
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                </tr>
                <tr class="bg-yellow-200">
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        4
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        فین در اینچ
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        <input type="text" name="fin_dar_inch" id="finDarInch" class="input-text" value="0"
                               onkeyup="calculate()">
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        fpi
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                </tr>
                <tr class="bg-yellow-200">
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        5
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        طول فین خورده
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        <input type="text" name="toole_fine_khorde" id="tooleFineKhorde" class="input-text" value="0"
                               onkeyup="calculate()">
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        MM
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                </tr>
                <tr class="bg-yellow-200">
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        6
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        تعداد لوله در یک ردیف
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        <input type="text" name="tedad_loole_dar_yek_radif" id="tedadLooleDarYekRadif"
                               class="input-text" value="0" onkeyup="calculate()">
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        عدد
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                </tr>
                <tr class="bg-yellow-200">
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        7
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        ضخامت تیوپ شیت و فریم
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        <input type="text" name="zekhamat_tioop_sheet_frame" id="zekhamatTioopSheetFrame"
                               class="input-text" value="0" onkeyup="calculate()">
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        MM
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">

                    </td>
                </tr>
                <tr class="bg-yellow-200">
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        8
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        سوزن والو
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        <input type="text" name="soozan_volv" id="soozanVolv" class="input-text" value="0"
                               onkeyup="calculate()">
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                        عدد
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center">
                    </td>
                </tr>

                @foreach($part->children as $child)
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $loop->index + 9 }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $child->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            <input type="text" name="soozan_volv" id="soozanVolv" class="input-text" value="0"
                                   onkeyup="calculate()">
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $child->unit }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ number_format($child->price) }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">

                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td class="border border-gray-300 p-4 text-lg font-bold text-center" colspan="4">
                        قیمت نهایی
                    </td>
                    <td class="border border-gray-300 p-4 text-lg font-bold text-center text-green-600" colspan="2">
                        1,569,000 تومان
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

        <div class="space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت مقادیر
            </button>
            <a href="#" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
