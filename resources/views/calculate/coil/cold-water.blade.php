<x-layout>

    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            let globalLoole = null;
            let globalFin = null;
            let globalCollectorAhani = null;
            let globalCollectorMessi = null;
            let globalZekhamat = null;
            let globalNoghre = null;

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

            let price0 , price1 , price2 , price3 , price4 , price5 , price6 , price7 , price8 , price9
                , price10 , price11 , price12 , price13 , price14 , price15 , price16 , price17 , price18 , price19
                , price20;

            function calculate() {
                let tooleCoil = parseFloat(document.getElementById('inputTooleCoil').value);
                let tedadRadif = parseFloat(document.getElementById('inputTedadRadif').value);
                let tedadMogheyiatLooleDarRadif = parseFloat(document.getElementById('inputTedadMogheyiatLooleDarRadif').value);
                let tedadLooleDarRadif = parseFloat(document.getElementById('inputTedadLooleDarRadif').value);
                let tedadMadarLoole = parseFloat(document.getElementById('inputTedadMadarLoole').value);
                let tedadSoorakhPakhshKon = parseFloat(document.getElementById('inputTedadSoorakhPakhshKon').value);
                let finDarInch = parseFloat(document.getElementById('inputFinDarInch').value);
                let khamCoilResult = parseFloat(document.getElementById('inputKham').value);
                let noePoosheshZedeKhordegi = document.getElementById('inputNoePoosheshZedeKhordegi').value;
                let satheCoilSection = document.getElementById('satheCoil');

                let collectorAhaniId = document.getElementById('inputCollectorAhani').value;
                let collectorMessiId = document.getElementById('inputCollectorMessi').value;
                let zekhamatFrameId = document.getElementById('inputZekhamatFrame').value;
                let looleMessiId = document.getElementById('inputLooleMessi').value;
                let finCoilId = document.getElementById('inputFin').value;
                let electrodNoghreId = document.getElementById('inputElectrodNoghre').value;

                let gamDarRadif;
                let gamDarErtefa;
                let sabetVaznVaragh;
                let vaznVaraghMasrafiResult;
                let poosheshZedeKhordegiResult;
                let tinerResult;
                let collectorAhaniResult;
                let collectorMessiResult;

                tedadSoorakhPakhshKon = 0;
                document.getElementById("inputTedadSoorakhPakhshKon").value = tedadSoorakhPakhshKon;

                if ((electrodNoghreId && globalNoghre !== electrodNoghreId) || (electrodNoghreId && globalNoghre === null)) {
                    sendDataElectrodNoghre(electrodNoghreId);
                    globalNoghre = electrodNoghreId;
                }

                if ((looleMessiId && globalLoole !== looleMessiId) || (looleMessiId && globalLoole === null)) {
                    sendDataLooleMessi(looleMessiId);
                    globalLoole = looleMessiId;
                }

                if ((finCoilId && globalFin !== finCoilId) || (finCoilId && globalFin === null)) {
                    sendDataFinCoil(finCoilId);
                    globalFin = finCoilId;
                }

                if (collectorAhaniId === '0') {
                    sendDataCollectorAhani('314');
                    valueSection[18].innerText = 0;
                    inputValues[18].value = 0;
                    price18 = 0;
                    totalPriceSection[18].innerText = 0;
                } else {
                    if ((collectorAhaniId && globalCollectorAhani !== collectorAhaniId) || (collectorAhaniId && globalCollectorAhani === null)) {
                        sendDataCollectorAhani(collectorAhaniId);
                        globalCollectorAhani = collectorAhaniId;
                    }
                }

                if (collectorMessiId === '0') {
                    sendDataCollectorMessi('313');
                    valueSection[17].innerText = 0;
                    inputValues[17].value = 0;
                    price17 = 0;
                    totalPriceSection[17].innerText = 0;
                } else {
                    if ((collectorMessiId && globalCollectorMessi !== collectorMessiId) || (collectorMessiId && globalCollectorMessi === null)) {
                        sendDataCollectorMessi(collectorMessiId);
                        globalCollectorMessi = collectorMessiId;
                    }
                }

                if ((zekhamatFrameId && globalZekhamat !== zekhamatFrameId) || (zekhamatFrameId && globalZekhamat === null)) {
                    sendDataVaraghGalvanize(zekhamatFrameId)
                    globalZekhamat = zekhamatFrameId;
                }

                let tedadFinMasrafiResult = tooleCoil * finDarInch;

                if (finCoilId === '60' || finCoilId === '63' || finCoilId === '67') {
                    zekhamatFin = 0.13; //130 micron
                }
                if (finCoilId === '61' || finCoilId === '64' || finCoilId === '68') {
                    zekhamatFin = 0.14; //140 micron
                }
                if (finCoilId === '62' || finCoilId === '65' || finCoilId === '69') {
                    zekhamatFin = 0.15; //150 micron
                }
                if (finCoilId === '66') {
                    zekhamatFin = 0.10; //100 micron
                }

                let tedadUResult = (tedadRadif * tedadLooleDarRadif) - tedadMadarLoole;

                //Loole Messi 5/8 - Zekhamat 0.5
                if (looleMessiId === '58') {
                    gamDarRadif = 32.5;
                    gamDarErtefa = 37.5;
                    sabetVaznVaragh = 130;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0055118;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 1.5 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 3.2;
                    azotResult = tedadRadif * satheCoilResult * 0.23;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 4.5;
                }

                //Loole Messi 5/8 - Zekhamat 0.63
                if (looleMessiId === '59') {
                    gamDarRadif = 32.5;
                    gamDarErtefa = 37.5;
                    sabetVaznVaragh = 130;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.006858;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 1.5 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 3.2;
                    azotResult = tedadRadif * satheCoilResult * 0.23;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 4.5;
                }

                //Loole Messi 3/8 - Zekhamat 0.35
                if (looleMessiId === '53') {
                    gamDarRadif = 21.6;
                    gamDarErtefa = 25;
                    sabetVaznVaragh = 110;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.002286;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 0.984 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2;
                    azotResult = tedadRadif * satheCoilResult * 0.15;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 3;
                }

                //Loole Messi 3/8 - Zekhamat 0.4
                if (looleMessiId === '54') {
                    gamDarRadif = 21.6;
                    gamDarErtefa = 25;
                    sabetVaznVaragh = 110;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0026162;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 0.984 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2;
                    azotResult = tedadRadif * satheCoilResult * 0.15;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 3;
                }

                //Loole Messi 3/8 - Zekhamat 0.5
                if (looleMessiId === '55') {
                    gamDarRadif = 21.6;
                    gamDarErtefa = 25;
                    sabetVaznVaragh = 110;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0032258;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 0.984 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2;
                    azotResult = tedadRadif * satheCoilResult * 0.15;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 3;
                }

                //Loole Messi 1/2 - Zekhamat 0.5
                if (looleMessiId === '56') {
                    gamDarRadif = 27.5;
                    gamDarErtefa = 31.75;
                    sabetVaznVaragh = 120;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0043688;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 1.25 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2.6;
                    azotResult = tedadRadif * satheCoilResult * 0.2;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 4;
                }

                //Loole Messi 1/2 - Zekhamat 0.63
                if (looleMessiId === '57') {
                    gamDarRadif = 27.5;
                    gamDarErtefa = 31.75;
                    sabetVaznVaragh = 130;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0054356;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 1.25 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2.6;
                    azotResult = tedadRadif * satheCoilResult * 0.2;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 4;
                }

                //Fin Al & Golden
                if (finCoilId === '60' || finCoilId === '61' || finCoilId === '62' || finCoilId === '63' || finCoilId === '64' || finCoilId === '65') {
                    vaznFinAlResult = ((ertefaFinResult * (gamDarRadif * tedadRadif) * zekhamatFin) * 2.7 * tedadFinMasrafiResult) / 1000000;
                } else {
                    //Fin Messi
                    vaznFinAlResult = ((ertefaFinResult * (gamDarRadif * tedadRadif) * zekhamatFin) * 8.96 * tedadFinMasrafiResult) / 1000000;
                }

                satheCoilSection.innerText = satheCoilResult.toFixed(2);

                let masahatTubSheet = (2 * ((ertefaFinResult + 70) * (sabetVaznVaragh + (gamDarRadif * tedadRadif)))) / 1000000;
                let masahatFrameBalaPayin = (2 * (((tooleCoil * 25.4) + 70) * (sabetVaznVaragh + (gamDarRadif * tedadRadif)))) / 1000000;
                let masahatVaraghMasrafi = masahatFrameBalaPayin + masahatTubSheet;

                //Varagh Galvnize - Zekhamat 0.5
                if (zekhamatFrameId === '1') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 0.5 * 7.874;
                }

                //Varagh Galvnize - Zekhamat 0.6
                if (zekhamatFrameId === '2') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 0.6 * 7.874;
                }

                //Varagh Galvnize - Zekhamat 0.8
                if (zekhamatFrameId === '3') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 0.8 * 7.874;
                }

                //Varagh Galvnize - Zekhamat 0.9
                if (zekhamatFrameId === '4') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 0.9 * 7.874;
                }

                //Varagh Galvnize - Zekhamat 1
                if (zekhamatFrameId === '5') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 1 * 7.874;
                }

                //Varagh Galvnize - Zekhamat 1.25
                if (zekhamatFrameId === '7') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 1.25 * 7.874;
                }

                //Varagh Galvnize - Zekhamat 1.5
                if (zekhamatFrameId === '8') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 1.5 * 7.874;
                }

                //Varagh Galvnize - Zekhamat 2
                if (zekhamatFrameId === '9') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 2 * 7.874;
                }

                //Varagh Galvnize - Zekhamat 2.5
                if (zekhamatFrameId === '10') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 2.5 * 7.874;
                }

                //Varagh Galvnize - Zekhamat 3
                if (zekhamatFrameId === '11') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 3 * 7.874;
                }

                //Varagh Galvnize - Zekhamat 4
                if (zekhamatFrameId === '12') {
                    vaznVaraghMasrafiResult = masahatVaraghMasrafi * 4 * 7.874;
                }

                let flaksMayeMasrafiResult = tedadUResult * 0.002;

                if (noePoosheshZedeKhordegi === '1') {
                    poosheshZedeKhordegiResult = satheCoilResult * tedadRadif * 0.05;
                    tinerResult = satheCoilResult * tedadRadif * 0.1;
                } else {
                    poosheshZedeKhordegiResult = 0;
                    tinerResult = 0;
                }

                let abeMasrafiResult = satheCoilResult * tedadRadif * 0.7;

                let oxygenMasrafiResult = tedadUResult * 0.006;

                let looleMessi316Result = 0;

                let roghaneTabkhirShavandeResult = tedadRadif * satheCoilResult * 0.015;

                if (collectorAhaniId === '70') {
                    collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 1.94 * 2;
                }
                if (collectorAhaniId === '71') {
                    collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 2.48 * 2;
                }
                if (collectorAhaniId === '72') {
                    collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 2.81 * 2;
                }
                if (collectorAhaniId === '73') {
                    collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 4.32 * 2;
                }
                if (collectorAhaniId === '74') {
                    collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 5.48 * 2;
                }
                if (collectorAhaniId === '75') {
                    collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 7.56 * 2;
                }
                if (collectorAhaniId === '76') {
                    collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 11.18 * 2;
                }


                if (collectorMessiId === '77') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.196 * 2;
                }
                if (collectorMessiId === '78') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.299 * 2;
                }
                if (collectorMessiId === '79') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.419 * 2;
                }
                if (collectorMessiId === '80') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.734 * 2;
                }
                if (collectorMessiId === '81') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.975 * 2;
                }
                if (collectorMessiId === '82') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 1.410 * 2;
                }
                if (collectorMessiId === '83') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 1.685 * 2;
                }
                if (collectorMessiId === '84') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 2.205 * 2;
                }
                if (collectorMessiId === '85') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 3.616 * 2;
                }
                if (collectorMessiId === '86') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 4.95 * 2;
                }
                if (collectorMessiId === '87') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 6.9 * 2;
                }
                if (collectorMessiId === '88') {
                    collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 7.89 * 2;
                }



                if(looleMessi316Result === looleMessi316Result && looleMessi316Result > 0 && typeof looleMessi316Result !== 'undefined') {
                    valueSection[0].innerText = looleMessi316Result.toFixed(2);
                    inputValues[0].value = looleMessi316Result.toFixed(2);
                    price0 = inputTotalPrice[0].value * looleMessi316Result;
                    totalPriceSection[0].innerText = Intl.NumberFormat().format(price0);
                } else {
                    valueSection[0].innerText = 0;
                    inputValues[0].value = 0;
                    price0 = 0;
                    totalPriceSection[0].innerText = 0;
                }

                if (abeMasrafiResult === abeMasrafiResult && abeMasrafiResult > 0 && typeof abeMasrafiResult !== 'undefined') {
                    valueSection[1].innerText = abeMasrafiResult.toFixed(2);
                    inputValues[1].value = abeMasrafiResult.toFixed(2);
                    price1 = inputTotalPrice[1].value * abeMasrafiResult;
                    totalPriceSection[1].innerText = Intl.NumberFormat().format(price1);
                } else {
                    valueSection[1].innerText = 0;
                    inputValues[1].value = 0;
                    price1 = 0;
                    totalPriceSection[1].innerText = 0;
                }

                //Gaze Shahri
                valueSection[2].innerText = 0.2;
                inputValues[2].value = 0.2;
                price2 = inputTotalPrice[2].value * 0.2;
                totalPriceSection[2].innerText = Intl.NumberFormat().format(price2);

                if(khamCoilResult === khamCoilResult && khamCoilResult > 0 && typeof khamCoilResult !== 'undefined') {
                    valueSection[3].innerText = khamCoilResult.toFixed(2);
                    inputValues[3].value = khamCoilResult.toFixed(2);
                    price3 = inputTotalPrice[3].value * khamCoilResult;
                    totalPriceSection[3].innerText = Intl.NumberFormat().format(price3);
                } else {
                    valueSection[3].innerText = 0;
                    inputValues[3].value = 0;
                    price3 = 0;
                    totalPriceSection[3].innerText = 0;
                }


                if (poosheshZedeKhordegiResult === poosheshZedeKhordegiResult && poosheshZedeKhordegiResult > 0 && typeof poosheshZedeKhordegiResult !== 'undefined') {
                    valueSection[4].innerText = poosheshZedeKhordegiResult.toFixed(2);
                    inputValues[4].value = poosheshZedeKhordegiResult.toFixed(2);
                    price4 = inputTotalPrice[4].value * poosheshZedeKhordegiResult;
                    totalPriceSection[4].innerText = Intl.NumberFormat().format(price4);
                } else {
                    valueSection[4].innerText = 0;
                    inputValues[4].value = 0;
                    price4 = 0;
                    totalPriceSection[4].innerText = 0;
                }

                if (tinerResult === tinerResult && tinerResult > 0 && typeof tinerResult !== 'undefined') {
                    valueSection[5].innerText = tinerResult.toFixed(2);
                    inputValues[5].value = tinerResult.toFixed(2);
                    price5 = inputTotalPrice[5].value * tinerResult;
                    totalPriceSection[5].innerText = Intl.NumberFormat().format(price5);
                } else {
                    valueSection[5].innerText = 0;
                    inputValues[5].value = 0;
                    price5 = 0;
                    totalPriceSection[5].innerText = 0;
                }

                if (flaksMayeMasrafiResult === flaksMayeMasrafiResult && flaksMayeMasrafiResult > 0 && typeof flaksMayeMasrafiResult !== 'undefined') {
                    valueSection[6].innerText = flaksMayeMasrafiResult.toFixed(2);
                    inputValues[6].value = flaksMayeMasrafiResult.toFixed(2);
                    price6 = inputTotalPrice[6].value * flaksMayeMasrafiResult;
                    totalPriceSection[6].innerText = Intl.NumberFormat().format(price6);
                } else {
                    valueSection[6].innerText = 0;
                    inputValues[6].value = 0;
                    price6 = 0;
                    totalPriceSection[6].innerText = 0;
                }

                if (azotResult === azotResult && azotResult > 0 && typeof azotResult !== 'undefined') {
                    valueSection[7].innerText = azotResult.toFixed(2);
                    inputValues[7].value = azotResult.toFixed(2);
                    price7 = inputTotalPrice[7].value * azotResult;
                    totalPriceSection[7].innerText = Intl.NumberFormat().format(price7);
                } else {
                    valueSection[7].innerText = 0;
                    inputValues[7].value = 0;
                    price7 = 0;
                    totalPriceSection[7].innerText = 0;
                }

                if (oxygenMasrafiResult === oxygenMasrafiResult && oxygenMasrafiResult > 0 && typeof oxygenMasrafiResult !== 'undefined') {
                    valueSection[8].innerText = oxygenMasrafiResult.toFixed(2);
                    inputValues[8].value = oxygenMasrafiResult.toFixed(2);
                    price8 = inputTotalPrice[8].value * oxygenMasrafiResult;
                    totalPriceSection[8].innerText = Intl.NumberFormat().format(price8);
                } else {
                    valueSection[8].innerText = 0;
                    inputValues[8].value = 0;
                    price8 = 0;
                    totalPriceSection[8].innerText = 0;
                }

                //Electrod Berenj
                if (vaznBerenjMasrafiResult === vaznBerenjMasrafiResult && vaznBerenjMasrafiResult > 0 && typeof vaznBerenjMasrafiResult !== 'undefined') {
                    valueSection[9].innerText = vaznBerenjMasrafiResult.toFixed(2);
                    inputValues[9].value = vaznBerenjMasrafiResult.toFixed(2);
                    price9 = inputTotalPrice[9].value * vaznBerenjMasrafiResult;
                    totalPriceSection[9].innerText = Intl.NumberFormat().format(price9);
                } else {
                    valueSection[9].innerText = 0;
                    inputValues[9].value = 0;
                    price9 = 0;
                    totalPriceSection[9].innerText = 0;
                }

                //Soozan Volf
                valueSection[10].innerText = 0;
                inputValues[10].value = 0;
                price10 = inputTotalPrice[10].value * 0;
                totalPriceSection[10].innerText = Intl.NumberFormat().format(price10);

                //Picho Mohre
                valueSection[11].innerText = 12;
                inputValues[11].value = 12;
                price11 = inputTotalPrice[11].value * 12;
                totalPriceSection[11].innerText = Intl.NumberFormat().format(price11);

                if (roghaneTabkhirShavandeResult === roghaneTabkhirShavandeResult && roghaneTabkhirShavandeResult > 0 && typeof roghaneTabkhirShavandeResult !== 'undefined') {
                    valueSection[12].innerText = roghaneTabkhirShavandeResult.toFixed(2);
                    inputValues[12].value = roghaneTabkhirShavandeResult.toFixed(2);
                    price12 = inputTotalPrice[12].value * roghaneTabkhirShavandeResult;
                    totalPriceSection[12].innerText = Intl.NumberFormat().format(price12);
                } else {
                    valueSection[12].innerText = 0;
                    inputValues[12].value = 0;
                    price12 = 0;
                    totalPriceSection[12].innerText = 0;
                }

                //Shire Havagiri
                valueSection[13].innerText = 1;
                inputValues[13].value = 1;
                price13 = inputTotalPrice[13].value * 1;
                totalPriceSection[13].innerText = Intl.NumberFormat().format(price13);

                //Shire Takhlie
                valueSection[14].innerText = 1;
                inputValues[14].value = 1;
                price14 = inputTotalPrice[14].value * 1;
                totalPriceSection[14].innerText = Intl.NumberFormat().format(price14);

                if (vaznVaraghMasrafiResult === vaznVaraghMasrafiResult && vaznVaraghMasrafiResult > 0 && typeof vaznVaraghMasrafiResult !== 'undefined') {
                    valueSection[15].innerText = vaznVaraghMasrafiResult.toFixed(2);
                    inputValues[15].value = vaznVaraghMasrafiResult.toFixed(2);
                    price15 = inputTotalPrice[15].value * vaznVaraghMasrafiResult;
                    totalPriceSection[15].innerText = Intl.NumberFormat().format(price15);
                } else {
                    valueSection[15].innerText = 0;
                    inputValues[15].value = 0;
                    price15 = 0;
                    totalPriceSection[15].innerText = 0;
                }
                if (looleMessiResult === looleMessiResult && looleMessiResult > 0 && typeof looleMessiResult !== 'undefined') {
                    valueSection[16].innerText = looleMessiResult.toFixed(2);
                    inputValues[16].value = looleMessiResult.toFixed(2);
                    price16 = inputTotalPrice[16].value * looleMessiResult;
                    totalPriceSection[16].innerText = Intl.NumberFormat().format(price16);
                } else {
                    valueSection[16].innerText = 0;
                    inputValues[16].value = 0;
                    price16 = 0;
                    totalPriceSection[16].innerText = 0;
                }

                if (vaznFinAlResult === vaznFinAlResult && vaznFinAlResult > 0 && typeof vaznFinAlResult !== 'undefined') {
                    valueSection[17].innerText = vaznFinAlResult.toFixed(2);
                    inputValues[17].value = vaznFinAlResult.toFixed(2);
                    price17 = inputTotalPrice[17].value * vaznFinAlResult;
                    totalPriceSection[17].innerText = Intl.NumberFormat().format(price17);
                } else {
                    valueSection[17].innerText = 0;
                    inputValues[17].value = 0;
                    price17 = 0;
                    totalPriceSection[17].innerText = 0;
                }

                if(collectorMessiResult === collectorMessiResult && collectorMessiResult > 0 && typeof collectorMessiResult !== 'undefined'){
                    valueSection[18].innerText = collectorMessiResult.toFixed(2);
                    inputValues[18].value = collectorMessiResult.toFixed(2);
                    price18 = inputTotalPrice[18].value * collectorMessiResult;
                    totalPriceSection[18].innerText = Intl.NumberFormat().format(price18);
                } else {
                    valueSection[18].innerText = 0;
                    inputValues[18].value = 0;
                    price18 = 0;
                    totalPriceSection[18].innerText = 0;
                }

                if (collectorAhaniResult === collectorAhaniResult && collectorAhaniResult > 0 && typeof collectorAhaniResult !== 'undefined') {
                    valueSection[19].innerText = collectorAhaniResult.toFixed(2);
                    inputValues[19].value = collectorAhaniResult.toFixed(2);
                    price19 = inputTotalPrice[19].value * collectorAhaniResult;
                    totalPriceSection[19].innerText = Intl.NumberFormat().format(price19);
                } else {
                    valueSection[19].innerText = 0;
                    inputValues[19].value = 0;
                    price19 = 0;
                    totalPriceSection[19].innerText = 0;
                }

                if (tedadUResult === tedadUResult && tedadUResult > 0 && typeof tedadUResult !== 'undefined') {
                    valueSection[20].innerText = tedadUResult.toFixed(2);
                    inputValues[20].value = tedadUResult.toFixed(2);
                    price20 = inputTotalPrice[20].value * tedadUResult;
                    totalPriceSection[20].innerText = Intl.NumberFormat().format(price20);
                } else {
                    valueSection[20].innerText = 0;
                    inputValues[20].value = 0;
                    price20 = 0;
                    totalPriceSection[20].innerText = 0;
                }

                if (vaznNoghreMasrafiResult === vaznNoghreMasrafiResult && vaznNoghreMasrafiResult > 0 && typeof vaznNoghreMasrafiResult !== 'undefined') {
                    valueSection[21].innerText = vaznNoghreMasrafiResult.toFixed(2);
                    inputValues[21].value = vaznNoghreMasrafiResult.toFixed(2);
                    price21 = inputTotalPrice[21].value * vaznNoghreMasrafiResult;
                    totalPriceSection[21].innerText = Intl.NumberFormat().format(price21);
                } else {
                    valueSection[21].innerText = 0;
                    inputValues[21].value = 0;
                    price21 = 0;
                    totalPriceSection[21].innerText = 0;
                }


                let finalPriceSection = document.getElementById('finalPriceSection');
                let inputFinalPrice = document.getElementById('inputFinalPrice');


                finalPrice = price0 + price1 + price2 + price3 + price4 + price5 + price6 + price7 + price8 + price9
                    + price10 + price11 + price12 + price13 + price14 + price15 + price16 + price17 + price18 + price19 + price20 + price21;
                finalPriceSection.innerText = Intl.NumberFormat().format(finalPrice);
                inputFinalPrice.value = finalPrice;
                document.getElementById("finalPriceTopSection").innerText = Intl.NumberFormat().format(finalPrice.toFixed(0));

                document.getElementById('coilName').value = `کویل آبسرد با سطح ${satheCoilResult.toFixed(2)} و طول ${tooleCoil.toFixed(2)}`;
            }

            function sendDataLooleMessi(id) {
                let looleMessiNameSection = document.getElementById('nameSection16');
                let looleMessiPriceSection = document.getElementById('priceSection16');
                let looleMessiUnitSection = document.getElementById('unitSection16');

                let uMessiNameSection = document.getElementById('nameSection20');
                let uMessiPriceSection = document.getElementById('priceSection20');

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

                        //Loole Messi 5/8
                        if (id === '58' || id === '59') {
                            sendDataUMessi('96');
                        }

                        //Loole Messi 3/8
                        if (id === '53' || id === '54' || id === '55') {
                            sendDataUMessi('89');
                        }

                        //Loole Messi 1/2
                        if (id === '56' || id === '57') {
                            sendDataUMessi('92');
                        }
                    }
                });
            }

            function sendDataUMessi(id) {
                let uMessiNameSection = document.getElementById('nameSection20');
                let uMessiPriceSection = document.getElementById('priceSection20');
                let uMessiUnitSection = document.getElementById('unitSection20');

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
                        uMessiNameSection.innerText = res.data.name;
                        uMessiPriceSection.innerText = Intl.NumberFormat().format(res.data.price);
                        uMessiUnitSection.innerText = res.data.unit;

                        document.getElementById('inputTotalPrice20').value = res.data.price;
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
                let collectorAhaniNameSection = document.getElementById('nameSection19');
                let collectorAhaniPriceSection = document.getElementById('priceSection19');
                let collectorAhaniUnitSection = document.getElementById('unitSection19');

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
                        document.getElementById('inputTotalPrice19').value = res.data.price
                    }
                });
            }

            function sendDataCollectorMessi(id) {
                let collectorMessiNameSection = document.getElementById('nameSection18');
                let collectorMessiPriceSection = document.getElementById('priceSection18');
                let collectorMessiUnitSection = document.getElementById('unitSection18');

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
                        document.getElementById('inputTotalPrice18').value = res.data.price
                    }
                });
            }

            function sendDataVaraghGalvanize(id) {
                let varaghGalvanizeNameSection = document.getElementById('nameSection15');
                let varaghGalvanizePriceSection = document.getElementById('priceSection15');
                let varaghGalvanizeUnitSection = document.getElementById('unitSection15');

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
                        document.getElementById('inputTotalPrice15').value = res.data.price
                    }
                });
            }

            function sendDataElectrodNoghre(id) {
                let electrodNoghreNameSection = document.getElementById('nameSection21');
                let electrodNoghrePriceSection = document.getElementById('priceSection21');
                let electrodNoghreUnitSection = document.getElementById('unitSection21');

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
                        electrodNoghreNameSection.innerText = res.data.name;
                        electrodNoghrePriceSection.innerText = Intl.NumberFormat().format(res.data.price);
                        electrodNoghreUnitSection.innerText = res.data.unit;
                        document.getElementById('inputTotalPrice21').value = res.data.price;
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
                        <select name="loole_messi" id="inputLooleMessi" class="input-text bg-yellow-300"
                                onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('id','53')->first()->id }}">
                                {{ \App\Models\Part::where('id','53')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','54')->first()->id }}">
                                {{ \App\Models\Part::where('id','54')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','55')->first()->id }}">
                                {{ \App\Models\Part::where('id','55')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','56')->first()->id }}">
                                {{ \App\Models\Part::where('id','56')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','57')->first()->id }}">
                                {{ \App\Models\Part::where('id','57')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','58')->first()->id }}">
                                {{ \App\Models\Part::where('id','58')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','59')->first()->id }}">
                                {{ \App\Models\Part::where('id','59')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputFin">فین کویل</label>
                        <select name="fin_coil" id="inputFin" class="input-text bg-yellow-300" onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('id','60')->first()->id }}">
                                {{ \App\Models\Part::where('id','60')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','61')->first()->id }}">
                                {{ \App\Models\Part::where('id','61')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','62')->first()->id }}">
                                {{ \App\Models\Part::where('id','62')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','63')->first()->id }}">
                                {{ \App\Models\Part::where('id','63')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','64')->first()->id }}">
                                {{ \App\Models\Part::where('id','64')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','65')->first()->id }}">
                                {{ \App\Models\Part::where('id','65')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','66')->first()->id }}">
                                {{ \App\Models\Part::where('id','66')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','67')->first()->id }}">
                                {{ \App\Models\Part::where('id','67')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','68')->first()->id }}">
                                {{ \App\Models\Part::where('id','68')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','69')->first()->id }}">
                                {{ \App\Models\Part::where('id','69')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadRadif">تعداد ردیف کویل</label>
                        <select name="tedad_radif_coil" id="inputTedadRadif" class="input-text bg-yellow-300"
                                onchange="calculate()">
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
                        <select name="fin_dar_inch" id="inputFinDarInch" class="input-text bg-yellow-300"
                                onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputKham">خم کویل</label>
                        <select name="kham" id="inputKham" class="input-text bg-yellow-300" onchange="calculate()">
                            <option value="0" selected>ندارد</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMadar">تعداد مدار کویل</label>
                        <select name="tedad_madar_coil" id="inputTedadMadar" class="input-text bg-gray-200 cursor-not-allowed" disabled>
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
                            <option value="{{ \App\Models\Part::where('id','1')->first()->id }}">
                                {{ \App\Models\Part::where('id','1')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','2')->first()->id }}">
                                {{ \App\Models\Part::where('id','2')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','3')->first()->id }}">
                                {{ \App\Models\Part::where('id','3')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','4')->first()->id }}">
                                {{ \App\Models\Part::where('id','4')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','5')->first()->id }}">
                                {{ \App\Models\Part::where('id','5')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','7')->first()->id }}">
                                {{ \App\Models\Part::where('id','7')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','8')->first()->id }}">
                                {{ \App\Models\Part::where('id','8')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','9')->first()->id }}">
                                {{ \App\Models\Part::where('id','9')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','10')->first()->id }}">
                                {{ \App\Models\Part::where('id','10')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','11')->first()->id }}">
                                {{ \App\Models\Part::where('id','11')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','12')->first()->id }}">
                                {{ \App\Models\Part::where('id','12')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputNoePoosheshZedeKhordegi">نوع پوشش ضد
                            خوردگی</label>
                        <select name="pooshesh_khordegi" id="inputNoePoosheshZedeKhordegi"
                                class="input-text bg-yellow-300"
                                onchange="calculate()">
                            <option value="0">ندارد</option>
                            <option value="1">هرسایت</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorAhani">هدر و کلکتور آهنی</label>
                        <select name="collector_ahani" id="inputCollectorAhani" class="input-text bg-yellow-300"
                                onchange="calculate()">
                            <option value="انتخاب کنید">ندارد</option>
                            <option value="0">ندارد</option>
                            <option value="{{ \App\Models\Part::where('id','70')->first()->id }}">
                                {{ \App\Models\Part::where('id','70')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','71')->first()->id }}">
                                {{ \App\Models\Part::where('id','71')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','72')->first()->id }}">
                                {{ \App\Models\Part::where('id','72')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','73')->first()->id }}">
                                {{ \App\Models\Part::where('id','73')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','74')->first()->id }}">
                                {{ \App\Models\Part::where('id','74')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','75')->first()->id }}">
                                {{ \App\Models\Part::where('id','75')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','76')->first()->id }}">
                                {{ \App\Models\Part::where('id','76')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorMessi">هدر و کلکتور مسی</label>
                        <select name="collector_messi" id="inputCollectorMessi" class="input-text bg-yellow-300"
                                onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="0">ندارد</option>
                            <option value="{{ \App\Models\Part::where('id','77')->first()->id }}">
                                {{ \App\Models\Part::where('id','77')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','78')->first()->id }}">
                                {{ \App\Models\Part::where('id','78')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','79')->first()->id }}">
                                {{ \App\Models\Part::where('id','79')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','80')->first()->id }}">
                                {{ \App\Models\Part::where('id','80')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','81')->first()->id }}">
                                {{ \App\Models\Part::where('id','81')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','82')->first()->id }}">
                                {{ \App\Models\Part::where('id','82')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','83')->first()->id }}">
                                {{ \App\Models\Part::where('id','83')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','84')->first()->id }}">
                                {{ \App\Models\Part::where('id','84')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','85')->first()->id }}">
                                {{ \App\Models\Part::where('id','85')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','86')->first()->id }}">
                                {{ \App\Models\Part::where('id','86')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','87')->first()->id }}">
                                {{ \App\Models\Part::where('id','87')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','88')->first()->id }}">
                                {{ \App\Models\Part::where('id','88')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTooleCoil">طول کویل (اینچ)</label>
                        <input name="toole_coil" type="text" class="input-text bg-yellow-300" id="inputTooleCoil"
                               value="0"
                               onkeyup="calculate()">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadLooleDarRadif">تعداد لوله در
                            ردیف</label>
                        <input name="tedad_loole_dar_radif" type="text" class="input-text bg-yellow-300"
                               id="inputTedadLooleDarRadif"
                               value="0" onkeyup="calculate()">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMogheyiatLooleDarRadif">
                            تعداد موقعیت یک لوله در ردیف
                        </label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadMogheyiatLooleDarRadif"
                               onkeyup="calculate()" value="0" name="tedad_mogheyiat_loole">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMadarLoole">تعداد مدار لوله</label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadMadarLoole" value="0"
                               onkeyup="calculate()"
                               name="tedad_madar_loole">
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputTedadSoorakhPakhshKon">
                            تعداد سوراخ پخش کن
                        </label>
                        <input type="text" class="input-text bg-gray-200 cursor-not-allowed" id="inputTedadSoorakhPakhshKon" value="0"
                               onkeyup="calculate()" name="tedad_soorakh_pakhshkon">
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputElectrodNoghre">
                            الکترود نقره
                        </label>
                        <select name="electrod_noghre" id="inputElectrodNoghre" class="input-text bg-yellow-300"
                                onchange="calculate()">
                            <option value="">
                                انتخاب کنید
                            </option>
                            <option value="{{ \App\Models\Part::where('id','104')->first()->id }}">
                                {{ \App\Models\Part::where('id','104')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','105')->first()->id }}">
                                {{ \App\Models\Part::where('id','105')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','108')->first()->id }}">
                                {{ \App\Models\Part::where('id','108')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','413')->first()->id }}">
                                {{ \App\Models\Part::where('id','413')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','109')->first()->id }}">
                                {{ \App\Models\Part::where('id','109')->first()->name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت مقادیر
            </button>
            <a href="{{ route('inquiries.index') }}" class="form-cancel-btn">
                انصراف
            </a>
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
        </div>
    </form>
</x-layout>
