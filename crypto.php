<code class="language-php" id="_code"><?php
if(!class_exists("Crypto"))
    include "inc/modules/crypto.php";

if(!class_exists("Random"))
    include "inc/modules/rng.php";

// Get Data
$data = isset($_GET["q"]) ? $_GET["q"] : "";
$data = trim($data);
$data = substr($data, 0, 15);
if(empty($data)) {
    echo "// Input is empty.";
} else {
    // Random Key Generation
    Random::seed(ip2long($_SERVER["REMOTE_ADDR"]));
    $keylen = Random::num(10, 20);
    $key = Random::string($keylen);
    
    // Get Outputs
    $enc = Crypto::Encrypt($data, $key);
    $dec = Crypto::Decrypt($enc["encrypted"], $key, base64_decode($enc["iv"]));
    
    // Get Module Code
    $sample = htmlentities(file_get_contents("inc/modules/crypto.php"));
    
    // Print Formatted Code
    printf($sample, htmlentities($data), $key, "array(\"iv\" => \"$enc[iv]\", \"encrypted\" => \"$enc[encrypted]\")", htmlentities($dec)); 
} ?></code>
<script>Prism.highlightElement($("#_code")[0])</script>