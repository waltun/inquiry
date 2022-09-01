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
            let globalSardande = null;

            //Value sections
            let valueSection = [];
            let totalPriceSection = [];
            let inputTotalPrice = [];
            let inputValues = [];
            for (let i = 0; i < 23; i++) {
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

            let price0, price1, price2, price3, price4, price5, price6, price7, price8, price9
                , price10, price11, price12, price13, price14, price15, price16, price17, price18, price19
                , price20, price21;

            function calculate() {
                let tooleCoil = parseFloat(document.getElementById('inputTooleCoil').value);
                let tedadRadif = parseFloat(document.getElementById('inputTedadRadif').value);
                let tedadMogheyiatLooleDarRadif = parseFloat(document.getElementById('inputTedadMogheyiatLooleDarRadif').value);
                let tedadLooleDarRadif = parseFloat(document.getElementById('inputTedadLooleDarRadif').value);
                let tedadMadarLoole = parseFloat(document.getElementById('inputTedadMadarLoole').value);
                let tedadSoorakhPakhshKon = parseFloat(document.getElementById('inputTedadSoorakhPakhshKon').value);
                let finDarInch = parseFloat(document.getElementById('inputFinDarInch').value);
                //let khamCoilResult = parseFloat(document.getElementById('inputKham').value);
                let noePoosheshZedeKhordegi = document.getElementById('inputNoePoosheshZedeKhordegi').value;
                let satheCoilSection = document.getElementById('satheCoil');
                let noeCoil = document.getElementById('inputNoeCoil').value;

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
                let electrod6013Result;
                let sarDandeResult;
                let looleMessi38Result;

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

                if (collectorAhaniId === collectorAhaniId && collectorAhaniId > 0 && typeof collectorAhaniId !== 'undefined') {
                    sendDataSardande('417');
                    if (noeCoil === '2') {
                        sarDandeResult = 0;
                    }
                    if (noeCoil === '4') {
                        sarDandeResult = 0;
                    }
                }
                if (collectorMessiId === collectorMessiId && collectorMessiId > 0 && typeof collectorMessiId !== 'undefined') {
                    if (('416' && globalSardande !== '416') || ('416' && globalSardande === null)) {
                        sendDataSardande('416');
                        globalSardande = '416';
                    }
                    if (noeCoil === '2') {
                        sarDandeResult = 2;
                    }
                    if (noeCoil === '4') {
                        sarDandeResult = 4;
                    }
                }
                if (collectorAhaniId === '0' && collectorMessiId === '0') {
                    sendDataSardande('166')
                    if (noeCoil === '2') {
                        sarDandeResult = 2;
                    }
                    if (noeCoil === '4') {
                        sarDandeResult = 4;
                    }
                    looleMessi38Result = tedadMadarLoole * noeCoil * 0.06 * 0.158;
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

                let tedadUResult;

                //Loole Messi 5/8 - Zekhamat 0.5
                if (looleMessiId === '58') {
                    tedadUResult = (tedadRadif * tedadLooleDarRadif) - tedadMadarLoole;
                    gamDarRadif = 32.5;
                    gamDarErtefa = 37.5;
                    sabetVaznVaragh = 100;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0055118;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 1.5 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadRadif * tedadLooleDarRadif * 2 * 2.8;
                    azotResult = tedadRadif * satheCoilResult * 0.23;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 4.5;
                }

                //Loole Messi 5/8 - Zekhamat 0.63
                if (looleMessiId === '59') {
                    tedadUResult = (tedadRadif * tedadLooleDarRadif) - tedadMadarLoole;
                    gamDarRadif = 32.5;
                    gamDarErtefa = 37.5;
                    sabetVaznVaragh = 100;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.006858;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 1.5 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadRadif * tedadLooleDarRadif * 2 * 2.8;
                    azotResult = tedadRadif * satheCoilResult * 0.23;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 4.5;
                }

                //Loole Messi 3/8 - Zekhamat 0.35
                if (looleMessiId === '53') {
                    tedadUResult = (tedadRadif * tedadLooleDarRadif / 2) - tedadMadarLoole;
                    gamDarRadif = 21.6;
                    gamDarErtefa = 25;
                    sabetVaznVaragh = 70;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.002286;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 0.984 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2;
                    azotResult = tedadRadif * satheCoilResult * 0.15;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 3;
                }

                //Loole Messi 3/8 - Zekhamat 0.4
                if (looleMessiId === '54') {
                    tedadUResult = (tedadRadif * tedadLooleDarRadif / 2) - tedadMadarLoole;
                    gamDarRadif = 21.6;
                    gamDarErtefa = 25;
                    sabetVaznVaragh = 70;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0026162;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 0.984 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2;
                    azotResult = tedadRadif * satheCoilResult * 0.15;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 3;
                }

                //Loole Messi 3/8 - Zekhamat 0.5
                if (looleMessiId === '55') {
                    tedadUResult = (tedadRadif * tedadLooleDarRadif / 2) - tedadMadarLoole;
                    gamDarRadif = 21.6;
                    gamDarErtefa = 25;
                    sabetVaznVaragh = 70;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0032258;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 0.984 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2;
                    azotResult = tedadRadif * satheCoilResult * 0.15;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 3;
                }

                //Loole Messi 1/2 - Zekhamat 0.5
                if (looleMessiId === '56') {
                    tedadUResult = (tedadRadif * tedadLooleDarRadif) - tedadMadarLoole;
                    gamDarRadif = 27.5;
                    gamDarErtefa = 31.75;
                    sabetVaznVaragh = 80;
                    looleMessiResult = (tooleCoil + 4) * tedadRadif * tedadLooleDarRadif * 0.0043688;
                    ertefaFinResult = tedadMogheyiatLooleDarRadif * gamDarErtefa;
                    satheCoilResult = (tedadMogheyiatLooleDarRadif * 1.25 * tooleCoil) / 144;
                    vaznNoghreMasrafiResult = tedadUResult * 2.6;
                    azotResult = tedadRadif * satheCoilResult * 0.2;
                    vaznBerenjMasrafiResult = (tedadMadarLoole * 2) * 4;
                }

                //Loole Messi 1/2 - Zekhamat 0.63
                if (looleMessiId === '57') {
                    tedadUResult = (tedadRadif * tedadLooleDarRadif) - tedadMadarLoole;
                    gamDarRadif = 27.5;
                    gamDarErtefa = 31.75;
                    sabetVaznVaragh = 80;
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

                let masahatTubSheet = (2 * ((ertefaFinResult) * (sabetVaznVaragh + (gamDarRadif * tedadRadif)))) / 1000000;
                let masahatVaraghMasrafi = masahatTubSheet;

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
                    if (noeCoil === '4') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 1.94 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 1.94 * 2;
                    }
                    electrod6013Result = 2 * 16;
                }
                if (collectorAhaniId === '71') {
                    if (noeCoil === '4') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 2.48 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 2.48 * 2;
                    }
                    electrod6013Result = 3 * 16;
                }
                if (collectorAhaniId === '72') {
                    if (noeCoil === '4') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 2.81 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 2.81 * 2;
                    }
                    electrod6013Result = 4 * 16;
                }
                if (collectorAhaniId === '73') {
                    if (noeCoil === '4') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 4.32 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 4.32 * 2;
                    }
                    electrod6013Result = 5 * 16;
                }
                if (collectorAhaniId === '74') {
                    if (noeCoil === '4') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 5.48 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 5.48 * 2;
                    }
                    electrod6013Result = 7 * 16;
                }
                if (collectorAhaniId === '75') {
                    if (noeCoil === '4') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 7.56 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 7.56 * 2;
                    }
                    electrod6013Result = 8 * 16;
                }
                if (collectorAhaniId === '76') {
                    if (noeCoil === '4') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 11.18 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorAhaniResult = ((ertefaFinResult + 150) / 1000) * 11.18 * 2;
                    }
                    electrod6013Result = 10 * 16;
                }

                if (collectorMessiId === '77') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.196 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.196 * 2;
                    }
                }
                if (collectorMessiId === '78') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.268 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.268 * 2;
                    }
                }
                if (collectorMessiId === '79') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.339 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.339 * 2;
                    }
                }
                if (collectorMessiId === '80') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.54 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.54 * 2;
                    }
                }
                if (collectorMessiId === '81') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.975 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 0.975 * 2;
                    }
                }
                if (collectorMessiId === '82') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 1.410 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 1.410 * 2;
                    }
                }
                if (collectorMessiId === '83') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 1.685 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 1.685 * 2;
                    }
                }
                if (collectorMessiId === '84') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 2.360 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 2.360 * 2;
                    }
                }
                if (collectorMessiId === '85') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 3.616 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 3.616 * 2;
                    }
                }
                if (collectorMessiId === '86') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 4.95 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 4.95 * 2;
                    }
                }
                if (collectorMessiId === '87') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 6.9 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 6.9 * 2;
                    }
                }
                if (collectorMessiId === '88') {
                    if (noeCoil === '4') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 7.89 * 2 * 2;
                    }
                    if (noeCoil === '2') {
                        collectorMessiResult = ((ertefaFinResult + 150) / 1000) * 7.89 * 2;
                    }
                }

                if (collectorAhaniId === '0' || collectorAhaniId === '') {
                    vaznBerenjMasrafiResult = 0;
                }

                if (collectorAhaniId === collectorAhaniId && collectorAhaniId > 0 && typeof collectorAhaniId !== 'undefined') {
                    document.getElementById("inputCollectorMessi").setAttribute("disabled","disabled");
                } else {
                    document.getElementById("inputCollectorMessi").removeAttribute("disabled");
                }

                if (collectorMessiId === collectorMessiId && collectorMessiId > 0 && typeof collectorMessiId !== 'undefined') {
                    document.getElementById("inputCollectorAhani").setAttribute("disabled","disabled");
                } else {
                    document.getElementById("inputCollectorAhani").removeAttribute("disabled");
                }

                if (looleMessi316Result === looleMessi316Result && looleMessi316Result > 0 && typeof looleMessi316Result !== 'undefined') {
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

                if (poosheshZedeKhordegiResult === poosheshZedeKhordegiResult && poosheshZedeKhordegiResult > 0 && typeof poosheshZedeKhordegiResult !== 'undefined') {
                    valueSection[3].innerText = poosheshZedeKhordegiResult.toFixed(2);
                    inputValues[3].value = poosheshZedeKhordegiResult.toFixed(2);
                    price3 = inputTotalPrice[3].value * poosheshZedeKhordegiResult;
                    totalPriceSection[3].innerText = Intl.NumberFormat().format(price3);
                } else {
                    valueSection[3].innerText = 0;
                    inputValues[3].value = 0;
                    price3 = 0;
                    totalPriceSection[3].innerText = 0;
                }

                if (tinerResult === tinerResult && tinerResult > 0 && typeof tinerResult !== 'undefined') {
                    valueSection[4].innerText = tinerResult.toFixed(2);
                    inputValues[4].value = tinerResult.toFixed(2);
                    price4 = inputTotalPrice[4].value * tinerResult;
                    totalPriceSection[4].innerText = Intl.NumberFormat().format(price4);
                } else {
                    valueSection[4].innerText = 0;
                    inputValues[4].value = 0;
                    price4 = 0;
                    totalPriceSection[4].innerText = 0;
                }

                if (flaksMayeMasrafiResult === flaksMayeMasrafiResult && flaksMayeMasrafiResult > 0 && typeof flaksMayeMasrafiResult !== 'undefined') {
                    valueSection[5].innerText = flaksMayeMasrafiResult.toFixed(2);
                    inputValues[5].value = flaksMayeMasrafiResult.toFixed(2);
                    price5 = inputTotalPrice[5].value * flaksMayeMasrafiResult;
                    totalPriceSection[5].innerText = Intl.NumberFormat().format(price5);
                } else {
                    valueSection[5].innerText = 0;
                    inputValues[5].value = 0;
                    price5 = 0;
                    totalPriceSection[5].innerText = 0;
                }

                if (azotResult === azotResult && azotResult > 0 && typeof azotResult !== 'undefined') {
                    valueSection[6].innerText = azotResult.toFixed(2);
                    inputValues[6].value = azotResult.toFixed(2);
                    price6 = inputTotalPrice[6].value * azotResult;
                    totalPriceSection[6].innerText = Intl.NumberFormat().format(price6);
                } else {
                    valueSection[6].innerText = 0;
                    inputValues[6].value = 0;
                    price6 = 0;
                    totalPriceSection[6].innerText = 0;
                }

                if (oxygenMasrafiResult === oxygenMasrafiResult && oxygenMasrafiResult > 0 && typeof oxygenMasrafiResult !== 'undefined') {
                    valueSection[7].innerText = oxygenMasrafiResult.toFixed(2);
                    inputValues[7].value = oxygenMasrafiResult.toFixed(2);
                    price7 = inputTotalPrice[7].value * oxygenMasrafiResult;
                    totalPriceSection[7].innerText = Intl.NumberFormat().format(price7);
                } else {
                    valueSection[7].innerText = 0;
                    inputValues[7].value = 0;
                    price7 = 0;
                    totalPriceSection[7].innerText = 0;
                }

                //Electrod Berenj
                if (vaznBerenjMasrafiResult === vaznBerenjMasrafiResult && vaznBerenjMasrafiResult > 0 && typeof vaznBerenjMasrafiResult !== 'undefined') {
                    valueSection[8].innerText = vaznBerenjMasrafiResult.toFixed(2);
                    inputValues[8].value = vaznBerenjMasrafiResult.toFixed(2);
                    price8 = inputTotalPrice[8].value * vaznBerenjMasrafiResult;
                    totalPriceSection[8].innerText = Intl.NumberFormat().format(price8);
                } else {
                    valueSection[8].innerText = 0;
                    inputValues[8].value = 0;
                    price8 = 0;
                    totalPriceSection[8].innerText = 0;
                }

                //Picho Mohre
                valueSection[9].innerText = 0;
                inputValues[9].value = 0;
                price9 = inputTotalPrice[9].value * 0;
                totalPriceSection[9].innerText = Intl.NumberFormat().format(price9);

                if (roghaneTabkhirShavandeResult === roghaneTabkhirShavandeResult && roghaneTabkhirShavandeResult > 0 && typeof roghaneTabkhirShavandeResult !== 'undefined') {
                    valueSection[10].innerText = roghaneTabkhirShavandeResult.toFixed(2);
                    inputValues[10].value = roghaneTabkhirShavandeResult.toFixed(2);
                    price10 = inputTotalPrice[10].value * roghaneTabkhirShavandeResult;
                    totalPriceSection[10].innerText = Intl.NumberFormat().format(price10);
                } else {
                    valueSection[10].innerText = 0;
                    inputValues[10].value = 0;
                    price10 = 0;
                    totalPriceSection[10].innerText = 0;
                }

                //Shire Havagiri
                if(noeCoil === '2') {
                    valueSection[11].innerText = 1;
                    inputValues[11].value = 1;
                    price11 = inputTotalPrice[11].value * 1;
                    totalPriceSection[11].innerText = Intl.NumberFormat().format(price11);
                }

                if(noeCoil === '4') {
                    valueSection[11].innerText = 2;
                    inputValues[11].value = 2;
                    price11 = inputTotalPrice[11].value * 2;
                    totalPriceSection[11].innerText = Intl.NumberFormat().format(price11);
                }


                //Shire Takhlie
                if(noeCoil === '2') {
                    valueSection[12].innerText = 1;
                    inputValues[12].value = 1;
                    price12 = inputTotalPrice[12].value * 1;
                    totalPriceSection[12].innerText = Intl.NumberFormat().format(price12);
                }
                if(noeCoil === '4') {
                    valueSection[12].innerText = 2;
                    inputValues[12].value = 2;
                    price12 = inputTotalPrice[12].value * 2;
                    totalPriceSection[12].innerText = Intl.NumberFormat().format(price12);
                }


                if (vaznVaraghMasrafiResult === vaznVaraghMasrafiResult && vaznVaraghMasrafiResult > 0 && typeof vaznVaraghMasrafiResult !== 'undefined') {
                    valueSection[13].innerText = vaznVaraghMasrafiResult.toFixed(2);
                    inputValues[13].value = vaznVaraghMasrafiResult.toFixed(2);
                    price13 = inputTotalPrice[13].value * vaznVaraghMasrafiResult;
                    totalPriceSection[13].innerText = Intl.NumberFormat().format(price13);
                } else {
                    valueSection[13].innerText = 0;
                    inputValues[13].value = 0;
                    price13 = 0;
                    totalPriceSection[13].innerText = 0;
                }

                if (looleMessiResult === looleMessiResult && looleMessiResult > 0 && typeof looleMessiResult !== 'undefined') {
                    valueSection[14].innerText = looleMessiResult.toFixed(2);
                    inputValues[14].value = looleMessiResult.toFixed(2);
                    price14 = inputTotalPrice[14].value * looleMessiResult;
                    totalPriceSection[14].innerText = Intl.NumberFormat().format(price14);
                } else {
                    valueSection[14].innerText = 0;
                    inputValues[14].value = 0;
                    price14 = 0;
                    totalPriceSection[14].innerText = 0;
                }

                if (vaznFinAlResult === vaznFinAlResult && vaznFinAlResult > 0 && typeof vaznFinAlResult !== 'undefined') {
                    valueSection[15].innerText = vaznFinAlResult.toFixed(2);
                    inputValues[15].value = vaznFinAlResult.toFixed(2);
                    price15 = inputTotalPrice[15].value * vaznFinAlResult;
                    totalPriceSection[15].innerText = Intl.NumberFormat().format(price15);
                } else {
                    valueSection[15].innerText = 0;
                    inputValues[15].value = 0;
                    price15 = 0;
                    totalPriceSection[15].innerText = 0;
                }

                if (collectorMessiResult === collectorMessiResult && collectorMessiResult > 0 && typeof collectorMessiResult !== 'undefined') {
                    valueSection[16].innerText = collectorMessiResult.toFixed(2);
                    inputValues[16].value = collectorMessiResult.toFixed(2);
                    price16 = inputTotalPrice[16].value * collectorMessiResult;
                    totalPriceSection[16].innerText = Intl.NumberFormat().format(price16);
                } else {
                    valueSection[16].innerText = 0;
                    inputValues[16].value = 0;
                    price16 = 0;
                    totalPriceSection[16].innerText = 0;
                }

                if (collectorAhaniResult === collectorAhaniResult && collectorAhaniResult > 0 && typeof collectorAhaniResult !== 'undefined') {
                    valueSection[17].innerText = collectorAhaniResult.toFixed(2);
                    inputValues[17].value = collectorAhaniResult.toFixed(2);
                    price17 = inputTotalPrice[17].value * collectorAhaniResult;
                    totalPriceSection[17].innerText = Intl.NumberFormat().format(price17);
                } else {
                    valueSection[17].innerText = 0;
                    inputValues[17].value = 0;
                    price17 = 0;
                    totalPriceSection[17].innerText = 0;
                }

                if (tedadUResult === tedadUResult && tedadUResult > 0 && typeof tedadUResult !== 'undefined') {
                    valueSection[18].innerText = tedadUResult.toFixed(2);
                    inputValues[18].value = tedadUResult.toFixed(2);
                    price18 = inputTotalPrice[18].value * tedadUResult;
                    totalPriceSection[18].innerText = Intl.NumberFormat().format(price18);
                } else {
                    valueSection[18].innerText = 0;
                    inputValues[18].value = 0;
                    price18 = 0;
                    totalPriceSection[18].innerText = 0;
                }

                if (vaznNoghreMasrafiResult === vaznNoghreMasrafiResult && vaznNoghreMasrafiResult > 0 && typeof vaznNoghreMasrafiResult !== 'undefined') {
                    valueSection[19].innerText = vaznNoghreMasrafiResult.toFixed(2);
                    inputValues[19].value = vaznNoghreMasrafiResult.toFixed(2);
                    price19 = inputTotalPrice[19].value * vaznNoghreMasrafiResult;
                    totalPriceSection[19].innerText = Intl.NumberFormat().format(price19);
                } else {
                    valueSection[19].innerText = 0;
                    inputValues[19].value = 0;
                    price19 = 0;
                    totalPriceSection[19].innerText = 0;
                }

                if (electrod6013Result === electrod6013Result && electrod6013Result > 0 && typeof electrod6013Result !== 'undefined') {
                    valueSection[20].innerText = vaznNoghreMasrafiResult.toFixed(2);
                    inputValues[20].value = vaznNoghreMasrafiResult.toFixed(2);
                    price20 = inputTotalPrice[20].value * vaznNoghreMasrafiResult;
                    totalPriceSection[20].innerText = Intl.NumberFormat().format(price20);
                } else {
                    valueSection[20].innerText = 0;
                    inputValues[20].value = 0;
                    price20 = 0;
                    totalPriceSection[20].innerText = 0;
                }

                if (sarDandeResult === sarDandeResult && sarDandeResult > 0 && typeof sarDandeResult !== 'undefined') {
                    valueSection[21].innerText = sarDandeResult.toFixed(2);
                    inputValues[21].value = sarDandeResult.toFixed(2);
                    price21 = inputTotalPrice[21].value * sarDandeResult;
                    totalPriceSection[21].innerText = Intl.NumberFormat().format(price21);
                } else {
                    valueSection[21].innerText = 0;
                    inputValues[21].value = 0;
                    price21 = 0;
                    totalPriceSection[21].innerText = 0;
                }

                if (looleMessi38Result === looleMessi38Result && looleMessi38Result > 0 && typeof looleMessi38Result !== 'undefined') {
                    valueSection[22].innerText = looleMessi38Result.toFixed(2);
                    inputValues[22].value = looleMessi38Result.toFixed(2);
                    price22 = inputTotalPrice[22].value * looleMessi38Result;
                    totalPriceSection[22].innerText = Intl.NumberFormat().format(price22);
                } else {
                    valueSection[22].innerText = 0;
                    inputValues[22].value = 0;
                    price22 = 0;
                    totalPriceSection[22].innerText = 0;
                }

                let finalPriceSection = document.getElementById('finalPriceSection');
                let inputFinalPrice = document.getElementById('inputFinalPrice');


                finalPrice = price0 + price1 + price2 + price3 + price4 + price5 + price6 + price7 + price8 + price9
                    + price10 + price11 + price12 + price13 + price14 + price15 + price16 + price17 + price18 + price19 + price20 + price21;
                finalPriceSection.innerText = Intl.NumberFormat().format(finalPrice);
                inputFinalPrice.value = finalPrice;
                document.getElementById("finalPriceTopSection").innerText = Intl.NumberFormat().format(finalPrice.toFixed(0));

                document.getElementById('coilName').value = `کویل فن کویلی با سطح ${satheCoilResult.toFixed(2)} و طول ${tooleCoil.toFixed(2)}`;
            }

            function sendDataLooleMessi(id) {
                let looleMessiNameSection = document.getElementById('nameSection14');
                let looleMessiPriceSection = document.getElementById('priceSection14');
                let looleMessiUnitSection = document.getElementById('unitSection14');

                let uMessiNameSection = document.getElementById('nameSection18');
                let uMessiPriceSection = document.getElementById('priceSection18');

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

                        document.getElementById('inputTotalPrice14').value = res.data.price;

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
                let uMessiNameSection = document.getElementById('nameSection18');
                let uMessiPriceSection = document.getElementById('priceSection18');
                let uMessiUnitSection = document.getElementById('unitSection18');

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

                        document.getElementById('inputTotalPrice18').value = res.data.price;
                    }
                });
            }

            function sendDataFinCoil(id) {
                let finCoilNameSection = document.getElementById('nameSection15');
                let finCoilPriceSection = document.getElementById('priceSection15');
                let finCoilUnitSection = document.getElementById('unitSection15');

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
                        document.getElementById('inputTotalPrice15').value = res.data.price
                    }
                });
            }

            function sendDataCollectorAhani(id) {
                let collectorAhaniNameSection = document.getElementById('nameSection17');
                let collectorAhaniPriceSection = document.getElementById('priceSection17');
                let collectorAhaniUnitSection = document.getElementById('unitSection17');

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
                        document.getElementById('inputTotalPrice17').value = res.data.price
                    }
                });
            }

            function sendDataCollectorMessi(id) {
                let collectorMessiNameSection = document.getElementById('nameSection16');
                let collectorMessiPriceSection = document.getElementById('priceSection16');
                let collectorMessiUnitSection = document.getElementById('unitSection16');

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
                        document.getElementById('inputTotalPrice16').value = res.data.price
                    }
                });
            }

            function sendDataVaraghGalvanize(id) {
                let varaghGalvanizeNameSection = document.getElementById('nameSection13');
                let varaghGalvanizePriceSection = document.getElementById('priceSection13');
                let varaghGalvanizeUnitSection = document.getElementById('unitSection13');

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
                        document.getElementById('inputTotalPrice13').value = res.data.price
                    }
                });
            }

            function sendDataElectrodNoghre(id) {
                let electrodNoghreNameSection = document.getElementById('nameSection19');
                let electrodNoghrePriceSection = document.getElementById('priceSection19');
                let electrodNoghreUnitSection = document.getElementById('unitSection19');

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
                        document.getElementById('inputTotalPrice19').value = res.data.price;
                    }
                });
            }

            function sendDataSardande(id) {
                let sarDandeNameSection = document.getElementById('nameSection21');
                let sarDandePriceSection = document.getElementById('priceSection21');
                let sarDandeUnitSection = document.getElementById('unitSection21');

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
                        sarDandeNameSection.innerText = res.data.name;
                        sarDandePriceSection.innerText = Intl.NumberFormat().format(res.data.price);
                        sarDandeUnitSection.innerText = res.data.unit;
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
                        <select name="kham" id="inputKham" class="input-text bg-gray-200 cursor-not-allowed"
                                onchange="calculate()" disabled>
                            <option value="0" selected>ندارد</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMadar">تعداد مدار کویل</label>
                        <select name="tedad_madar_coil" id="inputTedadMadar"
                                class="input-text bg-gray-200 cursor-not-allowed" disabled>
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
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorAhani">هدر و کلکتور آهنی</label>
                        <select name="collector_ahani" id="inputCollectorAhani" class="input-text bg-yellow-300"
                                onchange="calculate()">
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
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorMessi">هدر و کلکتور مسی</label>
                        <select name="collector_messi" id="inputCollectorMessi" class="input-text bg-yellow-300"
                                onchange="calculate()">
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
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputNoeCoil">
                            نوع کویل
                        </label>
                        <select name="pooshesh_khordegi" id="inputNoeCoil" class="input-text bg-yellow-300"
                                onchange="calculate()">
                            <option value="">انتخاب کنید</option>
                            <option value="4">4 لوله</option>
                            <option value="2">2 لوله</option>
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
                    <div class="col-span-3">
                        <label class="block mb-2 text-sm font-bold" for="inputTedadSoorakhPakhshKon">
                            تعداد سوراخ پخش کن
                        </label>
                        <input type="text" class="input-text bg-gray-200 cursor-not-allowed"
                               id="inputTedadSoorakhPakhshKon" value="0"
                               onkeyup="calculate()" name="tedad_soorakh_pakhshkon">
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
