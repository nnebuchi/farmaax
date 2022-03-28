

function downloadPdf(){


	const { jsPDF } = window.jspdf;

	const doc = new jsPDF();

	var elementHTML = $('#content').html();
	var specialElementHandlers = {
	    '#elementH': function (element, renderer) {
	        return true;
	    }
	};

	/*doc.text(elementHTML, 10, 10);
	doc.fromHTML(elementHTML, 15, 15, {
	    'width': 170,
	    'elementHandlers': specialElementHandlers
	});*/


	doc.html(elementHTML, {
    html2canvas: {
        // insert html2canvas options here, e.g.
        width: 200
	    },
	    callback: function () {
	       
	    }
	});

	// Save the PDF
	doc.save('sample-document.pdf');
}
