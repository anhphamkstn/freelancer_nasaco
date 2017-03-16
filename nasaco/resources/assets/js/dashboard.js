function fixdata(data) {
  var o = "", l = 0, w = 10240;
  for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint8Array(data.slice(l*w,l*w+w)));
  o+=String.fromCharCode.apply(null, new Uint8Array(data.slice(l*w)));
  return o;
}

var rABS = true;

function handleFile(e) {
    var files = e.target.files;
    var i, f;
    for (i = 0; i != files.length; ++i) {
        f = files[i];
        var reader = new FileReader();
        var name = f.name;
        reader.onload = function (e) {
            var data = e.target.result;

            var workbook;
            if (rABS) {
                /* if binary string, read with type 'binary' */
                workbook = XLSX.read(data, { type: 'binary' });
            } else {
                /* if array buffer, convert to base64 */
                var arr = fixdata(data);
                workbook = XLSX.read(btoa(arr), { type: 'base64' });
            }
            console.log(workbook)
            /* DO SOMETHING WITH workbook HERE */
        };
        reader.readAsBinaryString(f);
    }
}
document.getElementById('import-excel').addEventListener('change', handleFile, false);