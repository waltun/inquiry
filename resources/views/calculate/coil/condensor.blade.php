<x-layout>

    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            let globalLoole = null;
            let globalFin = null;
            let globalCollectorAhani = null;
            let globalCollectorMessi = null;
            let globalZekhamat = null;
            //Value sections
            let valueSection = [];
            let totalPriceSection = [];
            let inputTotalPrice = [];
            let inputValues = [];
            for (let i = 0; i < 22; i++) {
                valueSection[i] = document.getElementById('valueSection' + i);
                totalPriceSection[i] = document.getElementById('totalPriceSection' + i);
                inputTotalPrice[i] = document.getElementById('inputTotalPrice' + i);
                inputValues[i] = document.getElementById('inputValues' + i);
            }

            let finalPrice = 0;
            let zekhamatFin;
            let looleMessiResult;
            let vaznFinAlResult;
            let ertefaFinResult;
            let satheCoilResult;
            let vaznNoghreMasrafiResult;
            let azotResult;
            let vaznBerenjMasrafiResult;

            function calculate() {
                let tooleCoil = parseFloat(document.getElementById('inputTooleCoil').value);
                let tedadRadif = parseFloat(document.getElementById('inputTedadRadif').value);
                let tedadMogheyiatLooleDarRadif = parseFloat(document.getElementById('inputTedadMogheyiatLooleDarRadif').value);
                let tedadLooleDarRadif = parseFloat(document.getElementById('inputTedadLooleDarRadif').value);
                let looleMessiId = document.getElementById('inputLooleMessi').value;
                let tedadMadarLoole = parseFloat(document.getElementById('inputTedadMadarLoole').value);
                let finCoilId = document.getElementById('inputFin').value;
                let collectorAhaniId = document.getElementById('inputCollectorAhani').value;
                let collectorMessiId = document.getElementById('inputCollectorMessi').value;
                let zekhamatFrameId = document.getElementById('inputZekhamatFrame').value;
                let finDarInch = parseFloat(document.getElementById('inputFinDarInch').value);
                let tedadSoorakhPakhshKon = parseFloat(document.getElementById('inputTedadSoorakhPakhshKon').value);
                let noePoosheshZedeKhordegi = document.getElementById('inputNoePoosheshZedeKhordegi').value;
                let satheCoilSection = document.getElementById('satheCoil');

                let khamCoilResult = parseFloat(document.getElementById('inputKham').value);

                //-----------------
                if ((looleMessiId && globalLoole !== looleMessiId) || (looleMessiId && globalLoole === null)) {
                    sendDataLooleMessi(looleMessiId);
                    globalLoole = looleMessiId;
                }
                if ((finCoilId && globalFin !== finCoilId) || (finCoilId && globalFin === null)) {
                    sendDataFinCoil(finCoilId);
                    globalFin = finCoilId;
                }
                if ((collectorAhaniId && globalCollectorAhani !== collectorAhaniId) || (collectorAhaniId && globalCollectorAhani === null)) {
                    sendDataCollectorAhani(collectorAhaniId);
                    globalCollectorAhani = collectorAhaniId;
                }
                if ((collectorMessiId && globalCollectorMessi !== collectorMessiId) || (collectorMessiId && globalCollectorMessi === null)) {
                    sendDataCollectorMessi(collectorMessiId);
                    globalCollectorMessi = collectorMessiId;
                }
                if ((zekhamatFrameId && globalZekhamat !== zekhamatFrameId) || (zekhamatFrameId && globalZekhamat === null)) {
                    sendDataVaraghGalvanize(zekhamatFrameId)
                    globalZekhamat = zekhamatFrameId;
                }
                //-----------------

                let tedadFinMasrafiResult = tooleCoil * finDarInch;

                if (finCoilId === '51' || finCoilId === '53' || finCoilId === '53') {
                    zekhamatFin = 0.13;
                }
                if (finCoilId === '7' || finCoilId === '58') {
                    zekhamatFin = 0.14;
                }
                if (finCoilId === '52' || finCoilId === '54' || finCoilId === '59') {
                    zekhamatFin = 0.15;
                }
                if (finCoilId === '55' || finCoilId === '28') {
                    zekhamatFin = 0.10;
                }

                let tedadUResult = (tedadRadif * tedadLooleDarRadif) - tedadMadarLoole;

                let gamDarRadif;
                let gamDarErtefa;
                let sabetVaznVaragh;

                if (looleMessiId === '3') {
                    gamDarRadif = 32.5;
                    gamDarErtefa = 37.5;
                    sabetVaznVaragh = 130;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0055118;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 1.5 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 3.2;
                    azotResult = tedadRadif * satheCoilResult * 0.23;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 11;
                }
                if (looleMessiId === '47') {
                    gamDarRadif = 32.5;
                    gamDarErtefa = 37.5;
                    sabetVaznVaragh = 130;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.006858;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 1.5 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 3.2;
                    azotResult = tedadRadif * satheCoilResult * 0.23;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 11;
                }
                if (looleMessiId === '8') {
                    gamDarRadif = 21.6;
                    gamDarErtefa = 25;
                    sabetVaznVaragh = 110;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.002286;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 0.984 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2;
                    azotResult = tedadRadif * satheCoilResult * 0.15;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 7.6;
                }
                if (looleMessiId === '48') {
                    gamDarRadif = 21.6;
                    gamDarErtefa = 25;
                    sabetVaznVaragh = 110;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0026162;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 0.984 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2;
                    azotResult = tedadRadif * satheCoilResult * 0.15;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 7.6;
                }
                if (looleMessiId === '49') {
                    gamDarRadif = 21.6;
                    gamDarErtefa = 25;
                    sabetVaznVaragh = 110;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0032258;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 0.984 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2;
                    azotResult = tedadRadif * satheCoilResult * 0.15;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 7.6;
                }

                if (finCoilId === '51' || finCoilId === '52' || finCoilId === '53' || finCoilId === '54' || finCoilId === '55' || finCoilId === '7') {
                    vaznFinAlResult = ((ertefaFinResult * (gamDarRadif * tedadRadif) * zekhamatFin) * 2.7 * tedadFinMasrafiResult) / 1000000;
                } else {
                    vaznFinAlResult = ((ertefaFinResult * (gamDarRadif * tedadRadif) * zekhamatFin) * 8.96 * tedadFinMasrafiResult) / 1000000;
                }

                satheCoilSection.innerText = satheCoilResult.toFixed(2);

                let masahatTubSheet = (2 * ((ertefaFinResult + 70) * (sabetVaznVaragh + (gamDarRadif * tedadRadif)))) / 1000000;
                let masahatFrameBalaPayin = (2 * (((tooleCoil * 25.4) + 70) * (sabetVaznVaragh + (gamDarRadif * tedadRadif)))) / 1000000;
                let masahatVaraghMasrafi = masahatFrameBalaPayin + masahatTubSheet;

                let vaznVaraghMasrafiResult;

                if (zekhamatFrameId === '2') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 7.874;
                }
                if (zekhamatFrameId === '82') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 1.25 * 7.874;
                }
                if (zekhamatFrameId === '83') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 1.5 * 7.874;
                }
                if (zekhamatFrameId === '84') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 2 * 7.874;
                }
                if (zekhamatFrameId === '85') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 2.5 * 7.874;
                }
                if (zekhamatFrameId === '86') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 3 * 7.874;
                }
                if (zekhamatFrameId === '87') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 4 * 7.874;
                }

                let flaksMayeMasrafiResult = tedadUResult * 0.002;

                let poosheshZedeKhordegiResult;
                let tinerResult;
                if (noePoosheshZedeKhordegi === '1') {
                    poosheshZedeKhordegiResult = satheCoilResult * tedadRadif * 0.05;
                    tinerResult = satheCoilResult * tedadRadif * 0.1;
                } else {
                    poosheshZedeKhordegiResult = 0;
                    tinerResult = 0;
                }

                let abeMasrafiResult = satheCoilResult * tedadRadif * 0.7;

                let oxygenMasrafiResult = tedadUResult * 0.006;

                let looleMessi316Result = tedadSoorakhPakhshKon * 0.0365;

                let roghaneTabkhirShavandeResult = tedadRadif * satheCoilResult * 0.015;

                let collectorAhaniResult;
                if (collectorAhaniId === '62') {
                    collectorAhaniResult = ((ertefaFinResult + 250) / 1000) * 1.94;
                }
                if (collectorAhaniId === '63') {
                    collectorAhaniResult = ((ertefaFinResult + 250) / 1000) * 2.48;
                }
                if (collectorAhaniId === '64') {
                    collectorAhaniResult = ((ertefaFinResult + 250) / 1000) * 2.81;
                }
                if (collectorAhaniId === '65') {
                    collectorAhaniResult = ((ertefaFinResult + 250) / 1000) * 4.32;
                }
                if (collectorAhaniId === '66') {
                    collectorAhaniResult = ((ertefaFinResult + 250) / 1000) * 5.48;
                }
                if (collectorAhaniId === '67') {
                    collectorAhaniResult = ((ertefaFinResult + 250) / 1000) * 7.56;
                }
                if (collectorAhaniId === '68') {
                    collectorAhaniResult = ((ertefaFinResult + 250) / 1000) * 11.18;
                }

                let collectorMessiResult;
                if (tedadSoorakhPakhshKon > 0) {
                    if (collectorMessiId === '69') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 0.196);
                    }
                    if (collectorMessiId === '70') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 0.299);
                    }
                    if (collectorMessiId === '71') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 0.419);
                    }
                    if (collectorMessiId === '72') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 0.734);
                    }
                    if (collectorMessiId === '73') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 0.975);
                    }
                    if (collectorMessiId === '74') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 1.410);
                    }
                    if (collectorMessiId === '75') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 1.685);
                    }
                    if (collectorMessiId === '76') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 2.205);
                    }
                    if (collectorMessiId === '77') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 3.616);
                    }
                    if (collectorMessiId === '78') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 4.95);
                    }
                    if (collectorMessiId === '79') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 6.9);
                    }
                    if (collectorMessiId === '80') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 7.89);
                    }
                } else {
                    if (collectorMessiId === '69') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 0.196) * 2;
                    }
                    if (collectorMessiId === '70') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 0.299) * 2;
                    }
                    if (collectorMessiId === '71') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 0.419) * 2;
                    }
                    if (collectorMessiId === '72') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 0.734) * 2;
                    }
                    if (collectorMessiId === '73') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 0.975) * 2;
                    }
                    if (collectorMessiId === '74') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 1.410) * 2;
                    }
                    if (collectorMessiId === '75') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 1.685) * 2;
                    }
                    if (collectorMessiId === '76') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 2.205) * 2;
                    }
                    if (collectorMessiId === '77') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 3.616) * 2;
                    }
                    if (collectorMessiId === '78') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 4.95) * 2;
                    }
                    if (collectorMessiId === '79') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 6.9) * 2;
                    }
                    if (collectorMessiId === '80') {
                        collectorMessiResult = (((ertefaFinResult + 250) / 1000) * 7.89) * 2;
                    }
                }

                //--------------------
                valueSection[0].innerText = tedadUResult.toFixed(4);
                inputValues[0].value = tedadUResult.toFixed(4);
                let price0 = inputTotalPrice[0].value * tedadUResult;
                totalPriceSection[0].innerText = Intl.NumberFormat().format(price0);

                valueSection[1].innerText = tedadSoorakhPakhshKon.toFixed(4);
                inputValues[1].value = tedadSoorakhPakhshKon.toFixed(4);
                let price1 = inputTotalPrice[1].value * tedadSoorakhPakhshKon;
                totalPriceSection[1].innerText = Intl.NumberFormat().format(price1);

                valueSection[2].innerText = vaznVaraghMasrafiResult.toFixed(4);
                inputValues[2].value = vaznVaraghMasrafiResult.toFixed(4);
                let price2 = inputTotalPrice[2].value * vaznVaraghMasrafiResult;
                totalPriceSection[2].innerText = Intl.NumberFormat().format(price2);

                valueSection[3].innerText = vaznNoghreMasrafiResult.toFixed(4);
                inputValues[3].value = vaznNoghreMasrafiResult.toFixed(4);
                let price3 = inputTotalPrice[3].value * vaznNoghreMasrafiResult;
                totalPriceSection[3].innerText = Intl.NumberFormat().format(price3);

                valueSection[4].innerText = vaznBerenjMasrafiResult;
                inputValues[4].value = vaznBerenjMasrafiResult;
                let price4 = inputTotalPrice[4].value * vaznBerenjMasrafiResult;
                totalPriceSection[4].innerText = Intl.NumberFormat().format(price4);

                valueSection[5].innerText = 2;
                inputValues[5].value = 2;
                let price5 = inputTotalPrice[5].value * 2;
                totalPriceSection[5].innerText = Intl.NumberFormat().format(price5);

                valueSection[6].innerText = poosheshZedeKhordegiResult.toFixed(4);
                inputValues[6].value = poosheshZedeKhordegiResult.toFixed(4);
                let price6 = inputTotalPrice[6].value * poosheshZedeKhordegiResult;
                totalPriceSection[6].innerText = Intl.NumberFormat().format(price6);

                valueSection[7].innerText = tinerResult.toFixed(4);
                inputValues[7].value = tinerResult.toFixed(4);
                let price7 = inputTotalPrice[7].value * tinerResult;
                totalPriceSection[7].innerText = Intl.NumberFormat().format(price7);

                valueSection[8].innerText = 12;
                inputValues[8].value = 12;
                let price8 = inputTotalPrice[8].value * 12;
                totalPriceSection[8].innerText = Intl.NumberFormat().format(price8);

                valueSection[9].innerText = flaksMayeMasrafiResult.toFixed(4);
                inputValues[9].value = flaksMayeMasrafiResult.toFixed(4);
                let price9 = inputTotalPrice[9].value * flaksMayeMasrafiResult;
                totalPriceSection[9].innerText = Intl.NumberFormat().format(price9);

                valueSection[10].innerText = 0.2;
                inputValues[10].value = 0.2;
                let price10 = inputTotalPrice[10].value * 0.2;
                totalPriceSection[10].innerText = Intl.NumberFormat().format(price10);

                valueSection[11].innerText = roghaneTabkhirShavandeResult;
                inputValues[11].value = roghaneTabkhirShavandeResult;
                let price11 = inputTotalPrice[11].value * roghaneTabkhirShavandeResult;
                totalPriceSection[11].innerText = Intl.NumberFormat().format(price11);

                valueSection[12].innerText = oxygenMasrafiResult;
                inputValues[12].value = oxygenMasrafiResult;
                let price12 = inputTotalPrice[12].value * oxygenMasrafiResult;
                totalPriceSection[12].innerText = Intl.NumberFormat().format(price12);

                valueSection[13].innerText = azotResult;
                inputValues[13].value = azotResult;
                let price13 = inputTotalPrice[13].value * azotResult;
                totalPriceSection[13].innerText = Intl.NumberFormat().format(price13);

                valueSection[14].innerText = abeMasrafiResult;
                inputValues[14].value = abeMasrafiResult;
                let price14 = inputTotalPrice[14].value * abeMasrafiResult;
                totalPriceSection[14].innerText = Intl.NumberFormat().format(price14);

                valueSection[15].innerText = 0.11;
                inputValues[15].value = 0.11;
                let price15 = inputTotalPrice[15].value * 0.11;
                totalPriceSection[15].innerText = Intl.NumberFormat().format(price15);

                valueSection[16].innerText = looleMessiResult.toFixed(4);
                inputValues[16].value = looleMessiResult.toFixed(4);
                let price16 = inputTotalPrice[16].value * looleMessiResult;
                totalPriceSection[16].innerText = Intl.NumberFormat().format(price16);

                valueSection[17].innerText = vaznFinAlResult.toFixed(4);
                inputValues[17].value = vaznFinAlResult.toFixed(4);
                let price17 = inputTotalPrice[17].value * vaznFinAlResult;
                totalPriceSection[17].innerText = Intl.NumberFormat().format(price17);

                valueSection[18].innerText = looleMessi316Result.toFixed(4);
                inputValues[18].value = looleMessi316Result.toFixed(4);
                let price18 = inputTotalPrice[18].value * looleMessi316Result;
                totalPriceSection[18].innerText = Intl.NumberFormat().format(price18);

                valueSection[19].innerText = collectorMessiResult.toFixed(4);
                inputValues[19].value = collectorMessiResult.toFixed(4);
                let price19 = inputTotalPrice[19].value * collectorMessiResult;
                totalPriceSection[19].innerText = Intl.NumberFormat().format(price19);

                let price20;
                if (collectorAhaniResult) {
                    valueSection[20].innerText = collectorAhaniResult.toFixed(4);
                    inputValues[20].value = collectorAhaniResult.toFixed(4);
                    price20 = inputTotalPrice[20].value * collectorAhaniResult;
                    totalPriceSection[20].innerText = Intl.NumberFormat().format(price20);
                } else {
                    valueSection[20].innerText = 0;
                    inputValues[20].value = 0;
                    price20 = 0;
                    totalPriceSection[20].innerText = 0;
                }


                valueSection[21].innerText = khamCoilResult.toFixed(4);
                inputValues[21].value = khamCoilResult.toFixed(4);
                let price21 = inputTotalPrice[21].value * khamCoilResult;
                totalPriceSection[21].innerText = Intl.NumberFormat().format(price21);

                let finalPriceSection = document.getElementById('finalPriceSection');
                let inputFinalPrice = document.getElementById('inputFinalPrice');

                finalPrice = price0 + price1 + price2 + price3 + price4 + price5 + price6 + price7 + price8 + price9
                    + price10 + price11 + price12 + price13 + price14 + price15 + price16 + price17 + price18 + price19
                    + price20 + price21;

                finalPriceSection.innerText = Intl.NumberFormat().format(finalPrice);
                inputFinalPrice.value = finalPrice;
                document.getElementById("finalPriceTopSection").innerText = Intl.NumberFormat().format(finalPrice.toFixed(0));

                document.getElementById('coilName').value = `کویل کندانسور با سطح ${satheCoilResult.toFixed(2)} و طول ${tooleCoil.toFixed(2)}`;
            }

            function sendDataLooleMessi(id) {
                let looleMessiNameSection = document.getElementById('nameSection16');
                let looleMessiPriceSection = document.getElementById('priceSection16');
                let looleMessiUnitSection = document.getElementById('unitSection16');
                let uMessiNameSection = document.getElementById('nameSection0');
                let uMessiPriceSection = document.getElementById('priceSection0');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('calculateCoil.getData') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        looleMessiNameSection.innerText = res.data.name;
                        looleMessiPriceSection.innerText = Intl.NumberFormat().format(res.data.price);
                        looleMessiUnitSection.innerText = res.data.unit;

                        document.getElementById('inputTotalPrice16').value = res.data.price;

                        if (res.data.code === '5805' || res.data.code === '58063') {
                            uMessiNameSection.innerText = '{{ \App\Models\Part::where('code',58085)->first()->name }}';
                            uMessiPriceSection.innerText = '{{ number_format(\App\Models\Part::where('code',58085)->first()->price) }}'
                        }

                        if (res.data.code === '3804' || res.data.code === '3805' || res.data.code === '38035') {
                            uMessiNameSection.innerText = '{{ \App\Models\Part::where('code',38053)->first()->name }}';
                            uMessiPriceSection.innerText = '{{ number_format(\App\Models\Part::where('code',38053)->first()->price) }}'
                        }
                    }
                });
            }

            function sendDataFinCoil(id) {
                let finCoilNameSection = document.getElementById('nameSection17');
                let finCoilPriceSection = document.getElementById('priceSection17');
                let finCoilUnitSection = document.getElementById('unitSection17');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('calculateCoil.getData') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        finCoilNameSection.innerText = res.data.name;
                        finCoilPriceSection.innerText = Intl.NumberFormat().format(res.data.price);
                        finCoilUnitSection.innerText = res.data.unit;
                        document.getElementById('inputTotalPrice17').value = res.data.price
                    }
                });
            }

            function sendDataCollectorAhani(id) {
                let collectorAhaniNameSection = document.getElementById('nameSection20');
                let collectorAhaniPriceSection = document.getElementById('priceSection20');
                let collectorAhaniUnitSection = document.getElementById('unitSection20');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('calculateCoil.getData') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        collectorAhaniNameSection.innerText = res.data.name;
                        collectorAhaniPriceSection.innerText = Intl.NumberFormat().format(res.data.price);
                        collectorAhaniUnitSection.innerText = res.data.unit;
                        document.getElementById('inputTotalPrice20').value = res.data.price
                    }
                });
            }

            function sendDataCollectorMessi(id) {
                let collectorMessiNameSection = document.getElementById('nameSection19');
                let collectorMessiPriceSection = document.getElementById('priceSection19');
                let collectorMessiUnitSection = document.getElementById('unitSection19');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('calculateCoil.getData') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        collectorMessiNameSection.innerText = res.data.name;
                        collectorMessiPriceSection.innerText = Intl.NumberFormat().format(res.data.price);
                        collectorMessiUnitSection.innerText = res.data.unit;
                        document.getElementById('inputTotalPrice19').value = res.data.price
                    }
                });
            }

            function sendDataVaraghGalvanize(id) {
                let varaghGalvanizeNameSection = document.getElementById('nameSection2');
                let varaghGalvanizePriceSection = document.getElementById('priceSection2');
                let varaghGalvanizeUnitSection = document.getElementById('unitSection2');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('calculateCoil.getData') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        varaghGalvanizeNameSection.innerText = res.data.name;
                        varaghGalvanizePriceSection.innerText = Intl.NumberFormat().format(res.data.price);
                        varaghGalvanizeUnitSection.innerText = res.data.unit;
                        document.getElementById('inputTotalPrice2').value = res.data.price
                    }
                });
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

    <form method="POST" action="{{ route('calculateCoil.storeCondensor',[$part->id,$product->id]) }}">
        @csrf

        <input type="hidden" name="name" value="" id="coilName">

        <!-- Inputs -->
        <div class="my-4">
            <div class="bg-white rounded-md shadow-md border border-gray-200 py-4 px-6">
                <div class="mb-4 border-b border-gray-300 pb-3 flex justify-between items-center">
                    <div>
                        <p class="text-lg text-black">
                            اطلاعات ورودی {{ $part->name }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-4 space-x-reverse">
                        <p class="bg-indigo-500 rounded-md px-6 py-2 text-sm font-bold text-white">
                            سطح کویل :
                            <span id="satheCoil">0.00</span>
                        </p>
                        <p class="bg-green-500 rounded-md px-6 py-2 text-sm font-bold text-white">
                            قیمت نهایی :
                            <span id="finalPriceTopSection">0</span>
                            تومان
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputLooleMessi">لوله مسی کویل</label>
                        <select name="loole_messi" id="inputLooleMessi" class="input-text bg-yellow-300" onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('code','5805')->first()->id }}">
                                {{ \App\Models\Part::where('code','5805')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','58063')->first()->id }}">
                                {{ \App\Models\Part::where('code','58063')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','3804')->first()->id }}">
                                {{ \App\Models\Part::where('code','3804')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','3805')->first()->id }}">
                                {{ \App\Models\Part::where('code','3805')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','38035')->first()->id }}">
                                {{ \App\Models\Part::where('code','38035')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputFin">فین کویل</label>
                        <select name="fin_coil" id="inputFin" class="input-text bg-yellow-300" onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('code','130130')->first()->id }}">
                                {{ \App\Models\Part::where('code','130130')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','140140')->first()->id }}">
                                {{ \App\Models\Part::where('code','140140')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','150150')->first()->id }}">
                                {{ \App\Models\Part::where('code','150150')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','1301301')->first()->id }}">
                                {{ \App\Models\Part::where('code','1301301')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','1501501')->first()->id }}">
                                {{ \App\Models\Part::where('code','1501501')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','1001001')->first()->id }}">
                                {{ \App\Models\Part::where('code','1001001')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','100100100')->first()->id }}">
                                {{ \App\Models\Part::where('code','100100100')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','130130130')->first()->id }}">
                                {{ \App\Models\Part::where('code','130130130')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','140140140')->first()->id }}">
                                {{ \App\Models\Part::where('code','140140140')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','150150150')->first()->id }}">
                                {{ \App\Models\Part::where('code','150150150')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadRadif">تعداد ردیف کویل</label>
                        <select name="" id="inputTedadRadif" class="input-text bg-yellow-300" onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputFinDarInch">فین در اینچ</label>
                        <select name="" id="inputFinDarInch" class="input-text bg-yellow-300" onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="12">12</option>
                            <option value="14">14</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputKham">خم کویل</label>
                        <select name="" id="inputKham" class="input-text bg-yellow-300" onchange="calculate()">
                            <option value="0" selected>ندارد</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMadar">تعداد مدار کویل</label>
                        <select name="" id="inputTedadMadar" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputZekhamatFrame">ضخامت فریم کویل</label>
                        <select name="zekhamat_frame_coil" id="inputZekhamatFrame" class="input-text bg-yellow-300"
                                onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('code','1222')->first()->id }}">
                                {{ \App\Models\Part::where('code','1222')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','125222')->first()->id }}">
                                {{ \App\Models\Part::where('code','125222')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','15222')->first()->id }}">
                                {{ \App\Models\Part::where('code','15222')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','2222')->first()->id }}">
                                {{ \App\Models\Part::where('code','2222')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','25222')->first()->id }}">
                                {{ \App\Models\Part::where('code','25222')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','3222')->first()->id }}">
                                {{ \App\Models\Part::where('code','3222')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','4222')->first()->id }}">
                                {{ \App\Models\Part::where('code','4222')->first()->name }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputNoePoosheshZedeKhordegi">نوع پوشش ضد
                            خوردگی</label>
                        <select name="" id="inputNoePoosheshZedeKhordegi" class="input-text bg-yellow-300" onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="0">ندارد</option>
                            <option value="1">هرسایت</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorAhani">هدر و کلکتور آهنی</label>
                        <select name="collector_ahani" id="inputCollectorAhani" class="input-text bg-yellow-300"
                                onchange="calculate()">
                            <option value="">ندارد</option>
                            <option value="{{ \App\Models\Part::where('code','111000')->first()->id }}">
                                {{ \App\Models\Part::where('code','111000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','114000')->first()->id }}">
                                {{ \App\Models\Part::where('code','114000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','112000')->first()->id }}">
                                {{ \App\Models\Part::where('code','112000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','222000')->first()->id }}">
                                {{ \App\Models\Part::where('code','222000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','212000')->first()->id }}">
                                {{ \App\Models\Part::where('code','212000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','333000')->first()->id }}">
                                {{ \App\Models\Part::where('code','333000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','444000')->first()->id }}">
                                {{ \App\Models\Part::where('code','444000')->first()->name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorMessi">هدر و کلکتور مسی</label>
                        <select name="collector_messi" id="inputCollectorMessi" class="input-text bg-yellow-300"
                                onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('code','38000')->first()->id }}">
                                {{ \App\Models\Part::where('code','38000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','12000')->first()->id }}">
                                {{ \App\Models\Part::where('code','12000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','58000')->first()->id }}">
                                {{ \App\Models\Part::where('code','58000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','78000')->first()->id }}">
                                {{ \App\Models\Part::where('code','78000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','118000')->first()->id }}">
                                {{ \App\Models\Part::where('code','118000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','138000')->first()->id }}">
                                {{ \App\Models\Part::where('code','138000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','158000')->first()->id }}">
                                {{ \App\Models\Part::where('code','158000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','218000')->first()->id }}">
                                {{ \App\Models\Part::where('code','218000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','258000')->first()->id }}">
                                {{ \App\Models\Part::where('code','258000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','318000')->first()->id }}">
                                {{ \App\Models\Part::where('code','318000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','358000')->first()->id }}">
                                {{ \App\Models\Part::where('code','358000')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('code','418000')->first()->id }}">
                                {{ \App\Models\Part::where('code','418000')->first()->name }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTooleCoil">طول کویل (اینچ)</label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTooleCoil" value="0" onkeyup="calculate()">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadLooleDarRadif">تعداد لوله در
                            ردیف</label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadLooleDarRadif" value="0"
                               onkeyup="calculate()">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMogheyiatLooleDarRadif">
                            تعداد موقعیت یک لوله در ردیف
                        </label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadMogheyiatLooleDarRadif"
                               onkeyup="calculate()"
                               value="0">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMadarLoole">تعداد مدار لوله</label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadMadarLoole" value="0" onkeyup="calculate()">
                    </div>

                    <div class="col-span-4">
                        <label class="block mb-2 text-sm font-bold" for="inputTedadSoorakhPakhshKon">
                            تعداد سوراخ پخش کن
                        </label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadSoorakhPakhshKon" value="0"
                               onkeyup="calculate()">
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="mt-4">
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
                    @foreach($part->children as $index => $child)
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center" id="nameSection{{ $index }}">
                                {{ $child->name }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                <span id="valueSection{{ $index }}">0</span>
                                <input type="hidden" name="values[]" value="0" id="inputValues{{ $index }}">
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center" id="unitSection{{ $index }}">
                                {{ $child->unit }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                <span id="priceSection{{ $index }}">{{ number_format($child->price) }}</span>
                                <input type="hidden" name="" id="inputTotalPrice{{ $index }}"
                                       value="{{ $child->price }}">
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center"
                                id="totalPriceSection{{ $index }}">

                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td class="border border-gray-300 p-4 text-lg font-bold text-center" colspan="4">
                            قیمت نهایی
                        </td>
                        <td class="border border-gray-300 p-4 text-lg font-bold text-center text-green-600" colspan="2">
                            <span id="finalPriceSection"></span>
                            <input type="hidden" name="final_price" id="inputFinalPrice">
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

            <div class="space-x-2 space-x-reverse">
                <button type="submit" class="form-submit-btn">
                    ثبت مقادیر
                </button>
                <a href="{{ route('inquiries.index') }}" class="form-cancel-btn">
                    انصراف
                </a>
            </div>
        </div>
    </form>
</x-layout>
