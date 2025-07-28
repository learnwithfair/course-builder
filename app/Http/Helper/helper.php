<?php
function makeDirectory( $path ) {
    if ( file_exists( $path ) ) {
        return true;
    }

    return mkdir( $path, 0755, true );
}

function removeFile( $path ) {
    return file_exists( $path ) && is_file( $path ) ? @unlink( $path ) : false;
}

function uploadImage( $file, $location, $size = null, $old = null ) {
    // Create the directory if it doesn't exist
    $path = makeDirectory( $location );

    if ( !$path ) {
        throw new Exception( 'Directory could not be created.' );
    }

    // Remove old file if specified
    if ( !empty( $old ) ) {
        removeFile( $location . '/' . $old );
    }

    // Generate a unique name for the file
    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();

    // Move the uploaded file to the specified location
    $file->move( $location, $filename );

    return $filename;
}

function filePath( $folder_name ) {
    return 'assets/images/' . $folder_name;
}

function getFile( $folder_name, $filename ) {
    return asset( 'assets/images/' . $folder_name . '/' . $filename );
}