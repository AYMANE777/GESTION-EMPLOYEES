<?php
if($currentFileName == "dashboard")
{
	$pages["dashboard"] = "active";
}else if($currentFileName == "engagements")
{
	$pages["engagements"] = "active";
}else if($currentFileName == "inscriptions")
{
	$pages["inscriptions"] = "active";
}else if($currentFileName == "tout-les-groupes")
{
	$pages["groupes"] = "active";
}else if($currentFileName == "reclamations")
{
	$pages["reclamations"] = "active";
}else if($currentFileName == "entretiens")
{
	$pages["entretiens"] = "active";
}else if($currentFileName == "ajouter-tutorial")
{
	$pages["tutorials"] = "active";
}else if($currentFileName == "cad")
{
	$pages["cad"] = "active";
}
?>
<div class="menu-item">
	<a class="menu-link <?php echo $pages["dashboard"]; ?>" href="dashboard">
		<span class="menu-icon">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
			<span class="svg-icon svg-icon-5">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M3 7.19995H10C10.6 7.19995 11 6.79995 11 6.19995V3.19995C11 2.59995 10.6 2.19995 10 2.19995H3C2.4 2.19995 2 2.59995 2 3.19995V6.19995C2 6.69995 2.4 7.19995 3 7.19995Z" fill="black"/>
					<path opacity="0.3" d="M10.1 22H3.10001C2.50001 22 2.10001 21.6 2.10001 21V10C2.10001 9.4 2.50001 9 3.10001 9H10.1C10.7 9 11.1 9.4 11.1 9V20C11.1 21.6 10.7 22 10.1 22ZM13.1 18V21C13.1 21.6 13.5 22 14.1 22H21.1C21.7 22 22.1 21.6 22.1 21V18C22.1 17.4 21.7 17 21.1 17H14.1C13.5 17 13.1 17.4 13.1 18ZM21.1 2H14.1C13.5 2 13.1 2.4 13.1 3V14C13.1 14.6 13.5 15 14.1 15H21.1C21.7 15 22.1 14.6 22.1 14V3C22.1 2.4 21.7 2 21.1 2Z" fill="black"/>
				</svg>
			</span>
			<!--end::Svg Icon-->
		</span>
		<span class="menu-title">Tableau de bord</span>
	</a>
</div>
<div class="menu-item">
	<a class="menu-link <?php echo $pages["engagements"]; ?>" href="engagements">
		<span class="menu-icon">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
			<span class="svg-icon svg-icon-1">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="black"/>
					<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="black"/>
					<path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="black"/>
					<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="black"/>
				</svg>
			</span>
			<!--end::Svg Icon-->
		</span>
		<span class="menu-title">Les Engagements</span>
	</a>
</div>
<div class="menu-item">
	<a class="menu-link <?php echo $pages["inscriptions"]; ?>" href="inscriptions">
		<span class="menu-icon">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
			<span class="svg-icon svg-icon-5">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black"></path>
					<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black"></path>
				</svg>
			</span>
			<!--end::Svg Icon-->
		</span>
		<span class="menu-title">Les Inscriptions</span>
	</a>
</div>
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
	<span class="menu-link">
		<span class="menu-icon">
			<span class="svg-icon svg-icon-5">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
					<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
				</svg>
			</span>
		</span>
		<span class="menu-title">Les Groupes</span>
		<span class="menu-arrow"></span>
	</span>
	<div class="menu-sub menu-sub-accordion menu-active-bg">
        <div class="menu-item">
			<a class="menu-link <?php echo $pages["groupes"]; ?>" href="tout-les-groupes">
				<span class="menu-icon">
					<span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="black"/>
							<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="black"/>
							<path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="black"/>
							<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="black"/>
						</svg>
					</span>
				</span>
				<span class="menu-title">Tout les groupes</span>
			</a>
		</div>
		<div class="menu-item">
			<a class="menu-link <?php echo $pages["reclamations"]; ?>" href="reclamations">
				<span class="menu-icon">
					<span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
							<path d="M11.276 13.654C11.276 13.2713 11.3367 12.9447 11.458 12.674C11.5887 12.394 11.738 12.1653 11.906 11.988C12.0833 11.8107 12.3167 11.61 12.606 11.386C12.942 11.1247 13.1893 10.896 13.348 10.7C13.5067 10.4947 13.586 10.2427 13.586 9.944C13.586 9.636 13.4833 9.356 13.278 9.104C13.082 8.84267 12.69 8.712 12.102 8.712C11.486 8.712 11.066 8.866 10.842 9.174C10.6273 9.482 10.52 9.82267 10.52 10.196L10.534 10.574H8.826C8.78867 10.3967 8.77 10.2333 8.77 10.084C8.77 9.552 8.90067 9.07133 9.162 8.642C9.42333 8.20333 9.81067 7.858 10.324 7.606C10.8467 7.354 11.4813 7.228 12.228 7.228C13.1987 7.228 13.9687 7.44733 14.538 7.886C15.1073 8.31533 15.392 8.92667 15.392 9.72C15.392 10.168 15.322 10.5507 15.182 10.868C15.042 11.1853 14.874 11.442 14.678 11.638C14.482 11.834 14.2253 12.0533 13.908 12.296C13.544 12.576 13.2733 12.8233 13.096 13.038C12.928 13.2527 12.844 13.528 12.844 13.864V14.326H11.276V13.654ZM11.192 15.222H12.928V17H11.192V15.222Z" fill="black"/>
						</svg>
					</span>
				</span>
				<span class="menu-title">Les Réclamations</span>
			</a>
		</div>
	</div>
</div>
<div class="menu-item">
	<a class="menu-link <?php echo $pages["entretiens"]; ?>" href="entretiens">
	<span class="menu-icon">
		<span class="svg-icon svg-icon-1">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black"/>
					<path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black"/>
			</svg>
		</span>
	</span>
	<span class="menu-title">Les Entretiens</span>
	</a>
</div>
<div class="menu-item">
	<a class="menu-link <?php echo $pages["tutorials"]; ?>" href="ajouter-tutorial">
	<span class="menu-icon">
		<span class="svg-icon svg-icon-1">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
			<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black"/>
			<path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black"/>
			<path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black"/>
		</svg>
		</span>
	</span>
	<span class="menu-title">Support</span>
	</a>
</div>
<div class="menu-item">
	<a class="menu-link <?php echo $pages["cad"]; ?>" href="cad">
		<span class="menu-icon">
			<span class="svg-icon svg-icon-1">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="black"/>
					<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="black"/>
					<path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="black"/>
					<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="black"/>
				</svg>
			</span>
		</span>
		<span class="menu-title">Comite d'Auto Discipline</span>
	</a>
</div>