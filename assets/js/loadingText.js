var el = $("#loadingText");
var texts = [
   "Sorge für neue Lua-Errors..",
   "Haue den Kopf gegen die Wand..",
   "Das Vermögen von Elon Musk beträgt 264,6 Milliarden USD",
   "Lösche Serverdateien..",
   "Lade Modelle..",
   "Lade Lua-Scripts..",
   "Besuche den Discord..",
   "Amogus..",
   "Sende Crash-Reports..",
   "Mute Price wegen seiner Tastatur..",
   "Spamme Garry voll..",
   "Emily BLM ACAB is typing..",
   "Drehe mich im Kreis..",
];

var thisTexts = texts;

function getRndInteger(min, max) {
   return Math.floor(Math.random() * (max - min + 1)) + min;
}

function getRandomText() {
   var id = getRndInteger(0, thisTexts.length - 1);
   var text = thisTexts[id];
   thisTexts = texts.slice(0);
   thisTexts.splice(id, 1);
   return text;
}

var removeText;
removeText = function () {
   var text = el.html();
   var curIndex = text.length;
   var nextIndex;
   var dir = 0;
   nextIndex = function () {
      var thisStr = "";
      for (i = 0; i < curIndex; i++) {
         thisStr += text[i];
      }
      el.html(thisStr);
      if (curIndex == 0) {
         setTimeout(startNewText, 1000);
      } else {
         curIndex = curIndex - 1;
         setTimeout(nextIndex, 100);
      }
   }
   nextIndex();
}

var startNewText;
startNewText = function () {
   var text = getRandomText().split("");
   var curIndex = 0;
   var nextIndex;
   var dir = 0;
   nextIndex = function () {
      var thisStr = "";
      for (i = 0; i < curIndex; i++) {
         thisStr += text[i];
      }
      el.html(thisStr);
      if (curIndex == text.length) {
         setTimeout(removeText, 2500);
      } else {
         curIndex++;
         setTimeout(nextIndex, 100);
      }
   }
   nextIndex();
}
startNewText();