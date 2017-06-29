function imprimir(){
	var openpgp = window.openpgp;
	openpgp.initWorker({ path:'openpgp.worker.js' }); // set the relative web worker path
	document.write("Mensaje desde libreria con openpgp y worker");
}
