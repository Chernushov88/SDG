var vid = document.getElementById("my-video");
var p = document.getElementById("text");

function showTime() {
    let rabotaem;
    var dateObj = new Date();
    var hour = dateObj.getUTCHours() + 2;
    var minute = dateObj.getMinutes();
    var second = dateObj.getSeconds();
    let vremya = (hour*60*60*1000) + (minute*60*1000) + (second*1000);
    console.log(vremya);
    if (minute < 10) minute = "0" + minute;
    if (second < 10) second = "0" + second;
    let dlitelnostchas = 0;
    let dlitelnostminute = 60;
    let dlitelnostsec = 0;
    
    let nachaloH = 14;
    let nachaloM = 50;
    let nachaloS = 00;
    let nachalo = (nachaloH*60*60*1000)+(nachaloM*60*1000)+(nachaloS*1000)
    console.log(nachalo);
    let calcdlitelnost = (dlitelnostchas*60*60*1000) + (dlitelnostminute*60*1000)+(dlitelnostsec*1000);
    
    
    if ((vremya - nachalo >0) && (vremya - nachalo < calcdlitelnost) ) {
        rabotaem = true;
        p.innerHTML = 'Вебинар начался';
        vid.play();
    } else {
        rabotaem = false;
        p.innerHTML = ('<br>До начала вебинара: ' + ((((nachalo - vremya)/60)/60)/1000).toFixed(2) + "ч " + (((nachalo - vremya)/60)/1000).toFixed(0) + "м " + ((nachalo - vremya)/1000).toFixed(0) + "с");
        // вырубаем контрол и автоплей
        vid.pause();
        vid.controls = false;
    }
    return rabotaem;
}
var myVar = setInterval(showTime, 1000);