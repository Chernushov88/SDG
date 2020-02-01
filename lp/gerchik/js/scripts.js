/* ------------------------------------------------------------------------------------------------------------------------------------------------ */
/* Anton Lukashov | cassador.ru */

$(document).ready(function() {

  timer();



});

/* ------------------------------------------------------------------------------------------------------------------------------------------------ */
/* Functions: */


/* Timer */
function timer() {
  var now = new Date();
  var newDate = new Date((now.getMonth()+1)+"/"+now.getDate()+"/"+now.getFullYear()+" 23:59:59");
  var totalRemains = (newDate.getTime()-now.getTime());
  var Days = (parseInt(parseInt(totalRemains/1000)/(24*3600)));
  var Hours = (parseInt((parseInt(totalRemains/1000) - Days*24*3600)/3600));
  var Min = (parseInt(parseInt((parseInt(totalRemains/1000) - Days*24*3600) - Hours*3600)/60));
  var Sec = parseInt((parseInt(totalRemains/1000) - Days*24*3600) - Hours*3600) - Min*60;
  if (Sec<10) { Sec="0"+Sec }
  if (Min<10) { Min="0"+Min }
  if (Hours<10) { Hours="0"+Hours }
  if (Days<10) { Days="0"+Days }
  $(".day").each(function() { $(this).text(Days); });
  $(".hour").each(function() { $(this).text(Hours); });
  $(".min").each(function() { $(this).text(Min); });
  $(".sec").each(function() { $(this).text(Sec); });
  setTimeout(timer, 1000);
}
