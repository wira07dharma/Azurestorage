<?php
if (isset($_POST['submit'])) {
	if (isset($_POST['url'])) {
		$url = $_POST['url'];
	} else {
		header("Location: upload_foto.php");
	}
} else {
	header("Location: upload_foto.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	
	<body>
				
				<script type="text/javascript">
				    function processImage() {
				        // **********************************************
				        // *** Update or verify the following values. ***
				        // **********************************************
				 
				        // Replace <Subscription Key> with your valid subscription key.
				        var subscriptionKey = "439ccd15cc8f4540a8612299321e7eb4 ";
				 
				        // You must use the same Azure region in your REST API method as you used to
				        // get your subscription keys. For example, if you got your subscription keys
				        // from the West US region, replace "westcentralus" in the URL
				        // below with "westus".
				        //
				        // Free trial subscription keys are generated in the "westus" region.
				        // If you use a free trial subscription key, you shouldn't need to change
				        // this region.
				        var uriBase =
				            "https://southeastasia.api.cognitive.microsoft.com/vision/v2.0/analyze";
				 
				        // Request parameters.
				        var params = {
				            "visualFeatures": "Categories,Description,Color",
				            "details": "",
				            "language": "en",
				        };
				 
				        // Display the image.
				        var sourceImageUrl = "<?php echo $url ?>";
						document.querySelector("#sourceImage").src = sourceImageUrl;
				 
				        // Make the REST API call.
				        $.ajax({
				            url: uriBase + "?" + $.param(params),
				 
				            // Request headers.
				            beforeSend: function(xhrObj){
				                xhrObj.setRequestHeader("Content-Type","application/json");
				                xhrObj.setRequestHeader(
				                    "Ocp-Apim-Subscription-Key", subscriptionKey);
				            },
				 
				            type: "POST",
				 
				            // Request body.
				            data: '{"url": ' + '"' + sourceImageUrl + '"}',
				        })
				 
				        .done(function(data) {
				            // Show formatted JSON on webpage.
				            $("#responseTextArea").val(JSON.stringify(data, null, 2));
				        })
				 
				        .fail(function(jqXHR, textStatus, errorThrown) {
				            // Display error message.
				            var errorString = (errorThrown === "") ? "Error. " :
				                errorThrown + " (" + jqXHR.status + "): ";
				            errorString += (jqXHR.responseText === "") ? "" :
				                jQuery.parseJSON(jqXHR.responseText).message;
				            alert(errorString);
				        });
				    };
				</script>
				<br>
				
				<div id="wrapper" style="width:1020px; display:table;">
					<div id="jsonOutput" style="width:600px; display:table-cell;">
						<b>Response:</b><br><br>
						<textarea id="responseTextArea" class="UIInput"
							  style="width:580px; height:400px;" readonly=""></textarea>
					</div>
					<div id="imageDiv" style="width:420px; display:table-cell;">
						<b>Source Image:</b><br><br>
						<img id="sourceImage" width="400" /><br>						
						<h3 id="description">...</h3>
					</div>
				</div>
	</body>
</html>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>