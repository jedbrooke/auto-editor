document.addEventListener('drop', (event) => {
	event.preventDefault();
	event.stopPropagation();

	for (const f of event.dataTransfer.files) {

        // f.path contains file path
		// Using the path attribute to get absolute file path
		console.log('File Path of dragged files: ', f.path)
		document.getElementById("messages").innerHTML = "<p>File information: <strong>" + f.name +
		"</strong> type: <strong>" + f.type +
		"</strong> size: <strong>" + f.size +
		"</strong> bytes</p>" + document.getElementById("messages").innerHTML;
	}
});

document.addEventListener('dragover', (e) => {
	e.preventDefault();
	e.stopPropagation();
});

// document.addEventListener('dragenter', (event) => {
// 	console.log('File is in the Drop Space');
// });

// document.addEventListener('dragleave', (event) => {
// 	console.log('File has left the Drop Space');
// });
