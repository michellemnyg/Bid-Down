<?php
function cleanPHP($dir) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && str_ends_with($file->getFilename(), ".php") && !str_ends_with($file->getFilename(), ".blade.php")) {
            $content = file_get_contents($file->getPathname());
            
            // Block comments (non-docblock if we want, but user said all comments)
            $content = preg_replace("~/\*.*?\*/~s", "", $content);
            
            // Line comments not part of URL
            $content = preg_replace("~(?<!:)//.*~", "", $content);
            
            // Remove empty lines
            $content = preg_replace("/\n\s*\n/", "\n\n", $content);
            
            file_put_contents($file->getPathname(), $content);
        }
    }
}

cleanPHP("app/Http/Controllers");
cleanPHP("app/Models");
cleanPHP("routes");
echo "Done";
?>
