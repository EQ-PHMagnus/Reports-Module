let ImportFile = (function(){

	
	const collections = ["bets", "fights", "tax"];
	let _ui = [];

	function init() {
		bindEvents();
	}
	

	function bindEvents() {
		setOnclickEvents();
		setOnchangeEvents();
		setOnDropEvents();
	}

	function setOnclickEvents(){
		collections.forEach(browseFiles);
		function browseFiles(item, index) {
			$('.'+item).on('click', function(e){
				e.preventDefault();
				$('#'+item).click();
			});
		}
	}

	function setOnDropEvents(){
		collections.forEach(dropFiles);
		function dropFiles(item, index) {
			// drop events
			$('.body-'+item).bind({
				dragenter: function(ev) {
					$('.body-'+item).addClass("active");
					ev.preventDefault(); 
				},
				dragover: function(ev) {
					$('.body-'+item).addClass("active");
					ev.preventDefault(); 
				},
				dragleave: function(ev) {
					$('.body-'+item).removeClass("active");
					ev.preventDefault(); 
				},
				drop: function(ev) {
					$('#'+item).prop("files", ev.originalEvent.dataTransfer.files);
					let fileName = ev.originalEvent.dataTransfer.files[0].name;
					$('.list-'+item).addClass("hasFiles");
					$('.body-'+item).removeClass("active");
					validateFile(item,fileName);
					ev.preventDefault(); 
				}
			});
			
		}
	}

	function setOnchangeEvents(){
		collections.forEach(inputChange);
		function inputChange(item, index) {
			$('#'+item).on("change", handleFileSelect);
		}
	}

	function handleFileSelect(evt) {
		const [file] = evt.target.files;
		let type 	 = $(this).attr('id');
		let fileName = file.name;
		validateFile(type,fileName);
	}

	function validateFile(type,fileName){
		if(openFile(fileName) != 'excel'){
			alert(fileName + '; File format is not valid')
		}else{
			// hide drop and show progress file and file name
			$('.list-'+type).show();
			// $('.body-'+type).html(``);
			$('.list-'+type).html(`<div class="file file--">
				<div class="name"><span>${fileName}</span></div>
					<div class="progress active"></div>
						<div class="done">
							<a href="" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 1000 1000">
								<g><path id="path" d="M500,10C229.4,10,10,229.4,10,500c0,270.6,219.4,490,490,490c270.6,0,490-219.4,490-490C990,229.4,770.6,10,500,10z M500,967.7C241.7,967.7,32.3,758.3,32.3,500C32.3,241.7,241.7,32.3,500,32.3c258.3,0,467.7,209.4,467.7,467.7C967.7,758.3,758.3,967.7,500,967.7z M748.4,325L448,623.1L301.6,477.9c-4.4-4.3-11.4-4.3-15.8,0c-4.4,4.3-4.4,11.3,0,15.6l151.2,150c0.5,1.3,1.4,2.6,2.5,3.7c4.4,4.3,11.4,4.3,15.8,0l308.9-306.5c4.4-4.3,4.4-11.3,0-15.6C759.8,320.7,752.7,320.7,748.4,325z"</g>
							</svg></a>
						</div></div>`);

			// show save button
			$('.btn-'+type).addClass('active')
		}
	}

	

	
	return {
        init: init,
    }

})();

ImportFile.init();

	

	

