<html>
  <body>
    <input type="file" onchange="message.innerHTML='&nbsp;'"><br><br>
    <textarea rows="4" cols="75">‘→Kadıköy’</textarea>
    <div>&nbsp;</div>
    <input type="button" value="Create PDF with UTF support" onclick="readFile()">
    <br>
  </body>
</html>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js" crossorigin="anonymous"></script>
<script>
var fontInBase64 = '',
    fileName = '',
    message = document.querySelector('div'),
    txtForPdf = document.querySelector('textarea'),
    errorStr = '<b style="color:red">Please select a font file!</b>';

function readTextFile(file)
    {
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", file, false);
        rawFile.onreadystatechange = function ()
        {
            if(rawFile.readyState === 4)
            {
                if(rawFile.status === 200 || rawFile.status == 0)
                {
                    var allText = rawFile.responseText;
                    alert(allText);
                }
            }
        }
        rawFile.send(null);
    }

  //  readTextFile("webfonts/opensans/ARIALUNI.TTF");

function readFile()
{  /* var  file="http://localhost/SanalMarket/webfonts/opensans/ARIALUNI.ttf",
    reader = new FileReader();*/


  var file = document.querySelector('input[type=file]').files[0],
        reader = new FileReader();
        alert(file);
    if(file && file.name.split('.')[1].toLowerCase() != 'ttf')
    {
        message.innerHTML = errorStr;
        return;
    }

    if(txtForPdf.value.replace(/\s+/g, '').length < 1)
    {
        message.innerHTML = '<b style="color:red">Please write some Text!</b>';;
        return;
    }

    reader.onloadend = function()
    {
        fontInBase64 = reader.result.split(',')[1];
    //    fileName = file.name.replace(/\s+/g, '-');
      //  alert(fontInBase64);
    //    $("#base64").append(fontInBase64);
        createPDF(fontInBase64);
    }

    if(file) reader.readAsDataURL("http://localhost/SanalMarket/webfonts/opensans/ARIALUNI.ttf");
    else message.innerHTML = errorStr;
}


function createPDF(fontInBase64)
{
    var doc = new jsPDF('p','mm','a4');
        fileNameWithoutExtension = fileName.split('.')[0],
        lMargin = 15, // left margin in mm
        rMargin = 15, // right margin in mm
        pdfInMM = 210; // width of A4 in mm

    doc.addFileToVFS("webfonts/opensans/ARIALUNI.ttf",fontInBase64);
    doc.addFont("webfonts/opensans/ARIALUNI.ttf", fileNameWithoutExtension, 'normal');

    doc.setFont(fileNameWithoutExtension);
    doc.setFontSize(14);
    var splitParts = doc.splitTextToSize(txtForPdf.value, (pdfInMM - lMargin - rMargin));
    doc.text(15, 15, splitParts);

    doc.save('test.pdf');
}

function setHindiToTextArea()
{

}
</script>
