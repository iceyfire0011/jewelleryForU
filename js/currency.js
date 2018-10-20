function JSONscriptRequest(fullUrl) {
    this.fullUrl = fullUrl; 
    this.noCacheIE = '&noCacheIE=' + (new Date()).getTime();
    this.headLoc = document.getElementsByTagName("head").item(0);
    this.scriptId = 'YJscriptId' + JSONscriptRequest.scriptCounter++;
}
JSONscriptRequest.scriptCounter = 1;
JSONscriptRequest.prototype.buildScriptTag = function () {
    this.scriptObj = document.createElement("script");    
    this.scriptObj.setAttribute("type", "text/javascript");
    this.scriptObj.setAttribute("src", this.fullUrl + this.noCacheIE);
    this.scriptObj.setAttribute("id", this.scriptId);
}
JSONscriptRequest.prototype.removeScriptTag = function () {
    this.headLoc.removeChild(this.scriptObj);  
}

JSONscriptRequest.prototype.addScriptTag = function () {
    this.headLoc.appendChild(this.scriptObj);
}
function getExchangeRates(xvalue,xfrom,xto,xround) {
	if (xvalue > 0) {
		var xxdiv = Math.floor(Math.random()*99999999);
		document.write("<span id='xxresult_"+xxdiv+"'></span>");
		document.getElementById('xxresult_'+xxdiv).innerHTML = "<span style='color: #cccccc;'>Calculating ... please wait</span>";
		request = 'http://currencyconverter.55uk.net/currencyxml.json.php?xfrom='+xfrom+'&xto='+xto+'&xvalue='+xvalue+'&xround='+xround+'&callback=getMyRate&mydiv='+xxdiv;
		aObj = new JSONscriptRequest(request);
		aObj.buildScriptTag();
		aObj.addScriptTag();		
	}
}
function getExchangeRatesDiv(xxxdiv,xvalue,xfrom,xto,xround) {
	if (xvalue > 0) {
		document.getElementById(xxxdiv).innerHTML = "<span style='color: #cccccc;'>Calculating ... please wait</span>";
		request = 'http://currencyconverter.55uk.net/currencyxml.json.php?do=cform&xfrom='+xfrom+'&xto='+xto+'&xvalue='+xvalue+'&xround='+xround+'&callback=getMyRates&mydiv='+xxxdiv;
		aObj = new JSONscriptRequest(request);
		aObj.buildScriptTag();
		aObj.addScriptTag();		
	}
}