<!DOCTYPE html>
<html>
<body>
<h1>Cégregisztráció megerősítése</h1>
<p>Üdvözöljük!</p>
<ul>A cég alabbi adatait mentettük el:</ul>
<li>Cégnév: {{ $company->name }}</li>
<li>Cég e-mail címe: {{ $company->email }}</li>
@if ($company->logo_image_path)
    <li>Céglogó (csatolmányban)</li>
@endif
@if ($company->website_url)
    <li>Cég weboldala: {{ $company->website_url }}</li>
@endif
</body>
</html>
