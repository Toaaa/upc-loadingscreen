function getParameterByName(name,url){if(!url)url=window.location.href;name=name.replace(/[\[\]]/g,'\\$&');var regex=new RegExp('[?&]'+name+'(=([^&#]*)|&|#|$)'),results=regex.exec(url);if(!results)return null;if(!results[2])return '';return decodeURIComponent(results[2].replace(/\+/g,' '));}
function encodeHTML(s){return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/"/g,'&quot;');}
var mapnameQuery=getParameterByName('mapname');if(mapnameQuery!==null&&(typeof mapnameQuery==='string'||mapnameQuery instanceof String))$("#map").html(encodeHTML(mapnameQuery));var filesNeeded;var filesTotal=0;var filesDownloaded=0;function GameDetails(servername,serverurl,mapname,maxplayers,steamid,gamemode){$("#map").html(mapname);$("#maxplayers").html(maxplayers);$("#gamemode").html(gamemode);}
function SetFilesTotal(total){filesTotal=total;}
function DownloadingFile(fileName){filesDownloaded++;refreshProgress();setStatus("Downloading files...");}
function SetStatusChanged(status){if(status.indexOf("Getting Addon #")!=-1){filesDownloaded++;refreshProgress();}else if(status=="Retrieving server info..."){setProgress(23);}else if(status=="Workshop Complete"){setProgress(85);setStatusDisclaimer(false);}else if(status=="Sending client info..."){setProgress(100);}
setStatus(status);}
function SetFilesNeeded(needed){filesNeeded=needed+1;}
function refreshProgress(){progress=Math.floor(((filesDownloaded/filesNeeded)*100));setProgress(progress);$("#progress").html(progress+"%")}
function setProgress(progress){$("#loading-progress").css("width",progress+"%");}
function setStatus(text){$("#status").html(text);}
function setStatusDisclaimer(flag){if(flag){$("#disclaimer-wrapper").addClass("visible");}else{if($("#disclaimer-wrapper").hasClass("visible")){$("#disclaimer-wrapper").removeClass("visible");}}}