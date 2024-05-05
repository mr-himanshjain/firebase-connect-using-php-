<?php

require 'vendor/autoload.php'; // Include Firebase PHP SDK

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Initialize Firebase
// $serviceAccount = ServiceAccount::fromJsonFile('C:\Users\Shri\personal-datastorage-firebase-adminsdk-d9141-d9227e3e5c.json'); // Path to your Firebase credentials JSON file
$factory = (new Factory)
    ->withServiceAccount('personal-datastorage-firebase-adminsdk-d9141-d9227e3e5c.json')
    ->withDatabaseUri('https://console.firebase.google.com/u/0/project/personal-datastorage/storage/personal-datastorage.appspot.com/files');
$storage = $factory->createStorage();
$storageClient = $storage->getStorageClient();
$defaultBucket = $storage->getBucket();

$imagePath = 'Snapchat-1308088450.jpg';

// Specify the destination path in Firebase Storage
$destinationPath = basename($imagePath);

// Upload the image file to Firebase Storage
$defaultBucket->upload(file_get_contents($imagePath), [
    'name' => $destinationPath,
]);

// Once uploaded, you can retrieve the access token (download URL) for the uploaded image
$file = $defaultBucket->object($destinationPath);
$expirationDate = new DateTime();
$expirationDate->add(new DateInterval('P10Y'));
$downloadUrl = $file->signedUrl($expirationDate);
// Output the access token (download URL)
echo $downloadUrl;
echo "<pre>";
die;
