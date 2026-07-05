<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $application->tracking_no }}</title>
</head>
<body>
    <h1>IPTTBDO Review Details</h1>
    <p>Tracking No: {{ $application->tracking_no }}</p>
    <p>Title: {{ $application->title }}</p>
    <p>Branch: {{ $application->branchLabel() }}</p>
    <p>Type: {{ $application->formTypeLabel() }}</p>
    <p>Status: {{ $application->statusLabel() }}</p>
    <p>Submitted By: {{ $application->submittedBy?->name }} ({{ $application->submittedBy?->email }})</p>
    <p>Description: {{ $application->description }}</p>
    <p>Remarks: {{ $application->remarks }}</p>
</body>
</html>