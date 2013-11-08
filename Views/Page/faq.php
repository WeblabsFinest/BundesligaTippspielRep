<?php session_start() ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Weblab Bundesliga Tippspiel</title>
        <?php include "../../Scripts/php/header.php" ?>
        <script type="text/javascript">
        function toggle(control){
            var elem = document.getElementById(control);

            if(elem.style.display == "none")
            {
                elem.style.display = "inline";
            }
            else
            {
                elem.style.display = "none";
            }
        }
    </script>
    </head>
    <body>
        <div id="page">
            <?php include HOME_PHP."Views/Partial/_navigation.php" ?>
            <div id="sidebarLeft">
                <?php include HOME_PHP."Views/Partial/_login.php" ?>
            </div>
            <div id="content">
                <h2>H&auml;ufig gestellte Fragen</h2>
            <div id="faq">
            <a href="javascript:toggle('frage1')"  ><h3 class="grayBackground">Wie hoch ist die Wirtschaftlichkeit der Anlage?</h3></a>
            <div id="frage1" class="question grayBackground">
                Das Entwicklungsziel war eine Turbine mit hohem Wirkungsgrad bei möglichst geringen Herstellungskosten und optimaler ökologischer Nachhaltigkeit zu konstruieren. 
                Dabei lag eine einfach aufzubauende Serienproduktion immer im Fokus.<br/>
                Trotzdem kann der FLOWCONVERTER&trade; auf das jeweilige Einsatzgebiet angepasst werden, ohne die Basiskonstruktion zu verändern. 
                Mit dem Einsatz optimierter Generatoren erreicht der FLOWCONVERTER&trade; eine Wirkungsgrad von über cp 0,50 und ist somit anderen Technologien am Markt, 
                die freie Strömungen nutzen, überlegen.<br/><br/>
                Abhängig von der Fließgeschwindigkeit des Gewässers und dem lokalen Strompreis, 
                kann die Investition schon in wenigen Jahren zurückverdient werden.
            </div>
            <a href="javascript:toggle('frage2')"  ><h3>Was für eine Turbine ist der FLOWCONVERTER&trade;?</h3></a>
            <div id="frage2" style="display: none; width: 770px;">
                Der FLOWCONVERTER&trade; kann nicht mit einer Pelton-, Francis-, oder anderen auf dem Markt befindlichen Turbinen verglichen werden. 
                Es ist eine eigenständige, zum Patent angemeldete Turbine, die frei fließende Strömungen sehr effizient und mit einer völlig neuen komplexen hydrodynamischen Konfiguration nutzt.<br/>
                Die Läufer sind grundsätzlich als Auftriebsläufer konzipiert, die auch gleichzeitig mit 3 Turbinenflügeln anteilig Druckkräfte aufnehmen. 
                Sie positionieren sich immer automatisch in die optimale Laufposition.
                Im Gegenlauf positionieren sich dann 2 Läufer so, dass dieser Bereich ohne Gegendruck auf die Läufer passiert wird. 
                Eine weitere wichtige und neue Strömungsführungseigenschaft ist die Strömungsbeschleunigung über die Einlaufnase und die Unterdruckeigenschaft am Auslauf durch das Mantelstromprinzip.<br/><br/>
                Zusammenfassend kann man es so beschreiben:

                <ul class="list" >
                    <li>
                        Beschleunigung und Glättung der Strömung am Einlauf
                    </li>
                    <li>
                        Optimale Positionierung der Läufer bei gleichzeitig 3 angetriebenen Läufern
                    </li>
                    <li>
                        Beschleunigung der Strömung in der Turbine durch den Unterdruck im Auslauf
                    </li>
                </ul>
            </div>
            <a href="javascript:toggle('frage3')"  ><h3>Wie sind die Generatoren positioniert, was für Generatoren sind vorgesehen?</h3></a>
            <div id="frage3" style="display: none; width: 770px;">
                Hier gibt es grundsätzlich zwei Varianten. Der FLOWCONVERTER&trade; verfügt über zwei Wellen, die durch die einfließende Strömung nach innen angetrieben werden.
                    <ul class="list">
                        <li>
                            Bei starken Strömungen wird auf jede Welle ein getriebeloser, direkt angetriebener Generator mit der erforderlichen Nenndrehzahl montiert. 
                        </li>
                        <li>
                            Bei langsameren Strömungen werden die beiden Wellen über Zahnräder gekoppelt. 
                            Mit einer Übersetzung an einem der Kopplungszahnräder wird dann ein Generator mit der erforderlichen Nenndrehzahl montiert. 
                        </li>
                    </ul>
                Bisher verwenden wir herkömmliche, am Markt erhältliche Generatoren. 
                Mit Beginn der Serienproduktion sollen dann speziell für den FLOWCONVERTER&trade; entwickelte Generatoren zum Einsatz kommen, 
                damit der optimale Wirkungsgrad erreicht werden kann. Diese Generatoren sollen für eine Lebensdauer von mindestens 20 Jahren konzipiert werden.
            </div>
            <a href="javascript:toggle('frage4')"  ><h3>Wie verhält sich die Anlage bei Gegenständen im Gewässer (z.B. Treibgut, Algen)?</h3></a>
            <div id="frage4" style="display: none; width: 770px;">
                Den  FLOWCONVERTER&trade; können Festkörper wie Blätter, Äste und Treibgut in der Größe von bis zu 10 cm x 10 cm problemlos passieren. 
                Bei einzeln stehenden Turbinen ist die Strömungsführung so ausgelegt, das Treibgut vor dem Einlauf beschleunigt wird und damit zwangsweise über den Außenbereich weggeleitet wird. 
                Größeres Treibgut muss wie bei herkömmlichen Installationen abgeblockt oder umgelenkt werden.
            </div>
            <a href="javascript:toggle('frage5')"  ><h3>Existieren bereits Erkenntnisse über Service- und Instandhaltungsaufwände und –zyklen?</h3></a>
            <div id="frage5" style="display: none; width: 770px;">
                Der FLOWCONVERTER&trade; ist ein wartungsarmes Kleinwasserkraftwerk. Die Konstruktion ist robust ausgelegt und mit hochwertigen, 
                seit langem bewährten Materialien und Teilen ausgestattet, die  jahrelang wartungsfrei arbeiten können. 
                Eine Vielzahl bestehender Wasserkraftanlagen haben dies über Jahrzehnte bewiesen.
            </div>
            <a href="javascript:toggle('frage6')"  ><h3>Wie wird der FLOWCONVERTER&trade; im Fließgewässer positioniert?</h3></a>
            <div id="frage6" style="display: none; width: 770px;">
                Der FLOWCONVERTER&trade; kann komplett unter der Wasseroberfläche installiert werden. Bei kleineren Gewässern können die Generatoren jedoch auch über der Wasseroberfläche geplant werden. 
            </div>
            <a href="javascript:toggle('frage7')"  ><h3>Kann die Anlage wechselnde Fließrichtungen (z.B. Strömungen im Meer) verarbeiten?</h3></a>
            <div id="frage7" style="display: none; width: 770px;">
                Ja, insbesondere die Nutzung von Tiden ist ein idealer Einsatzort. 
                Der FLOWCONVERTER&trade; kann sehr einfach auf dem  Meeresboden verankert werden, ist skalierbar 
                (d.h. es kann eine Vielzahl an FLOWCONVERTER&trade; neben- und  hintereinander installiert werden)  und dreht sich "automatisch" konstruktionsbedingt in die jeweilige Strömung.
            </div>
            <a href="javascript:toggle('frage8')"  ><h3>Wie verhält sich die Strömung hinter dem FLOWCONVERTER&trade;?</h3></a>
            <div id="frage8" style="display: none; width: 770px;">
                Hinter dem FLOWCONVERTER&trade; entsteht eine verwirbelte Strömung, die nach kurzer Zeit jedoch in eine laminare Strömung übergeht. 
                Die Wasserverwirbelung hinter und im FLOWCONVERTER&trade; verbessern auch erheblich die Wasserqualität. 
                Wann die Strömung sich wieder erholt hängt von vielen Faktoren ab. Insbesondere der Fließgeschwindigkeit, Positionierung, Größe und Anzahl der FLOWCONVERTER&trade;, 
                die Beschaffenheit von Gewässergrund und Ufer, Naturgewässer oder künstlicher Kanal etc.. <br/>
                Diese Daten werden bei der Vorplanung ermittelt.
                Es können jedoch Schätzungen basierend auf Erfahrungswerten vorgenommen werden, wenn die örtlichen Gegebenheiten bekannt sind.
            </div>
            <a href="javascript:toggle('frage9')"  ><h3>Wie wird der FLOWCONVERTER&trade; optimal positioniert?</h3></a>
            <div id="frage9" style="display: none; width: 770px;">
                Das hängt von den örtlichen Gegebenheiten ab. Für jede Anlage wird eine individuelle Planung erstellt. 
                Es sind eine Vielzahl von Positionierungen des FLOWCONVERTER&trade; denkbar, versetzt, einzeln, mittig und nebeneinander. <br/>
                Am effektivsten ist es, wenn eine Reihe FLOWCONVERTER&trade; nebeneinander und auch übereinander über die gesamte Gewässerbreite montiert wird. 
                Dabei kann eine Wirkungsgraderhöhung von bis zu 30 % erreicht werden. Diese Methode ist sehr gut in künstlichen Kanalbauwerken anwendbar.
            </div>
            <a href="javascript:toggle('frage10')"  ><h3>Was wäre eine ideale Wasserströmung für den FLOWCONVERTER&trade;?</h3></a>
            <div id="frage10" style="display: none; width: 770px;">
                Wie bei jeder Wasserturbine ist natürlich eine sehr laminare Strömung die beste Variante. 
                Hier kann der FLOWCONVERTER&trade; jedoch aufgrund seiner neuen Strömungsführungs-technologie und der 
                Positionierung der Läufer seine wesentlichen Vorteile gegenüber anderen Technologien zur Wasserkraftnutzung bei frei umströmten Turbinen beweisen. <br/>
                Durch die spezielle Ausformung der Einlaufnase wird auch eine sehr turbulente Strömung stark geglättet und beschleunigt und trifft so auf 3 Läufer 
                gleichzeitig die angetrieben werden. Die Läufer der Turbine sind so konstruiert, dass sie problemlos mit turbulenten Strömungen nahe am optimalen Leistungsbereich arbeiten    
            </div>
            <a href="javascript:toggle('frage11')"  ><h3>Müssen besondere bauseitige Maßnahmen getroffen werden um die Wasserströmung in den FLOWCONVERTER&trade; einzuleiten?</h3></a>
            <div id="frage11" style="display: none; width: 770px;">
                Nein, der FLOWCONVERTER&trade; ist so konzipiert, das er optimal in jeder Wasserströmung sofort einsetzbar ist. 
                Er muss jedoch individuell am Standort fixiert werden. 
                Das richtet sich nach dem Einsatzort und wird in der Vorplanung festgelegt. 
            </div>
            <a href="javascript:toggle('frage12')"  ><h3>Werden Fische beeinträchtigt oder gar verletzt?</h3></a>
            <div id="frage12" style="display: none; width: 770px;">
                Gefahren für Fische bestehen auf Grund des genutzten Systems nicht. Anders als bei Lauf- oder Fallkraftwerken entsteht beim FLOWCONVERTER&trade; 
                keine Strömunsbeschleunigung die Fische "ansaugen" oder dem Fisch keine Ausweichmöglichkeit geben. 
                Der FLOWCONVERTER&trade; wird als natürliches Hindernis erkannt, wie viele andere Installationen in Gewässern. <br/>
                Die Wasserverwirbelungen hinter und im FLOWCONVERTER&trade; verbessern auch die Wasserqualität, was die Fischbestände positiv beeinflussen kann.
            </div>
            <a href="javascript:toggle('frage13')"  ><h3>Wie verhält sich die Anlage bei Eis?</h3></a>
            <div id="frage13" style="display: none; width: 770px;">
                Grundsätzlich wird der FLOWCONVERTER&trade; so eingebaut, dass eine Vereisung praktisch nicht möglich ist. 
                Gewässer mit Fließgeschwindigkeiten über 1,5 m/s gefrieren in der Regel nicht und somit besteht auch keine Eisganggefahr. <br/>
                Die planmäßige, vollständige Installation unter Wasser beugt ebenfalls einer Vereisung vor. 
            </div>
            </div>
            </div>
            <div id="sidebarRight">
                
            </div>
        </div>
    </body>
</html>

