<?php 

require_once("config/database.inc.php");

if (isset($_COOKIE['loggedInUser'])) {
    $userID = $_COOKIE['loggedInUser'];

    $query = "SELECT * FROM users WHERE id = :userid";

    $statement = $conn->prepare($query);
    $statement->bindParam(':userid', $userID);
    $statement->execute();

    if ($statement->rowCount() === 1) {
        $userData = $statement->fetch(PDO::FETCH_ASSOC);
    } else {
        $userData = false;
    }
} 

?>

<nav class="fixed top-0 left-0 right-0 z-40 px-4 py-1 flex justify-between items-center bg-primarylightmode dark:bg-primarydarkmode">
	<div class="flex">
		<button id="hamburger-big" class="hidden sm:block hover:bg-secondarylightmode dark:hover:bg-secondarydarkmode md:p-2 rounded-full">
			<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
				<path d="M21 6H3V5h18v1zm0 5H3v1h18v-1zm0 6H3v1h18v-1z"></path>
			</svg>
		</button>
		<button id="hamburger-small" class="sm:hidden hover:bg-secondarylightmode dark:hover:bg-secondarydarkmode md:p-2 rounded-full">
			<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
				<path d="M21 6H3V5h18v1zm0 5H3v1h18v-1zm0 6H3v1h18v-1z"></path>
			</svg>
		</button>
		<a class="text-3xl font-bold flex items-center leading-none mx-2 md:mx-1" href="index.php">
			<svg class="ml-0 ml-2 sm:ml-3 w-[90px] external-icon" version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 900.000000 202.000000" preserveAspectRatio="xMidYMid meet">
				<g class="fill-gray-900 dark:fill-white" transform="translate(0.000000,202.000000) scale(0.100000,-0.100000)">
        			<path class="fill-[#FF0000]" d="M1130 2009 c-480 -11 -774 -38 -865 -78 -54 -24 -129 -92 -160 -146 -104 -176 -130 -1018 -45 -1417 28 -131 65 -192 153 -252 29 -19 79 -42 112 -50 301 -76 1883 -79 2214 -5 78 17 130 46 186 103 64 66 87 121 109 261 31 197 39 359 33 673 -10 563 -52 718 -221 817 -24 14 -75 32 -112 40 -114 24 -416 45 -726 50 -161 3 -311 7 -333 8 -22 2 -177 0 -345 -4z m560 -877 c96 -55 183 -107 193 -114 16 -12 1 -23 -145 -108 -483 -278 -574 -330 -580 -330 -9 0 -11 844 -2 852 5 6 78 -35 534 -300z"/>
        			<path d="M7340 1928 c0 -2 -1 -402 -3 -891 l-2 -887 117 0 117 0 11 55 c6 30 14 55 17 55 3 0 21 -17 39 -39 95 -110 288 -120 379 -19 45 49 60 85 88 202 19 82 21 121 21 381 1 315 -11 416 -58 521 -40 87 -122 131 -226 121 -84 -7 -163 -55 -212 -127 -16 -24 -17 -9 -17 303 l-1 327 -135 0 c-74 0 -135 -1 -135 -2z m443 -719 c47 -36 52 -77 52 -419 0 -350 -6 -392 -57 -435 -16 -14 -41 -25 -54 -25 -37 0 -91 26 -103 48 -7 14 -11 145 -11 393 l0 372 44 43 c50 50 87 57 129 23z"/>
        			<path d="M3210 1765 c0 -58 -1 -108 -2 -112 -2 -5 60 -10 137 -13 l140 -5 0 -743 0 -742 138 0 137 0 0 745 0 745 140 0 140 0 0 115 0 115 -415 0 -415 0 0 -105z"/>
        			<path d="M5650 1765 c0 -58 -1 -108 -2 -112 -2 -5 60 -10 137 -13 l140 -5 3 -742 2 -743 135 0 135 0 0 745 0 745 140 0 140 0 0 115 0 115 -415 0 -415 0 0 -105z"/>
        			<path d="M4129 1647 c-68 -45 -76 -123 -18 -171 56 -48 126 -47 173 3 52 54 42 124 -23 168 -43 29 -89 29 -132 0z"/>
        			<path d="M4648 1416 c-62 -23 -85 -43 -112 -99 -43 -87 -49 -187 -42 -702 3 -253 6 -461 6 -463 0 -1 71 -1 158 0 l157 3 5 509 5 508 33 28 c42 35 81 44 104 23 16 -15 18 -57 20 -542 l3 -526 156 -3 156 -2 7 115 c4 64 6 299 5 522 l-2 406 27 19 c32 24 88 27 111 8 38 -31 39 -53 40 -565 l0 -500 136 -3 137 -3 7 133 c4 73 5 313 3 533 -4 350 -7 406 -22 449 -40 111 -94 155 -200 163 -94 8 -166 -16 -226 -76 l-47 -47 -24 37 c-32 52 -87 81 -168 86 -84 6 -116 -6 -119 -43 -3 -36 -8 -40 -29 -22 -65 57 -206 84 -285 54z"/>
        			<path d="M8537 1420 c-102 -18 -174 -73 -218 -165 -55 -114 -64 -182 -64 -480 0 -301 10 -371 66 -484 52 -104 127 -147 270 -158 248 -18 399 104 399 324 l0 63 -43 0 c-24 0 -78 3 -119 6 l-75 7 -7 -62 c-10 -85 -24 -119 -57 -136 -67 -35 -129 -6 -148 69 -6 25 -11 97 -11 160 l0 116 236 0 237 0 -6 223 c-6 241 -15 299 -62 386 -30 55 -82 98 -145 120 -46 16 -192 22 -253 11z m157 -205 c31 -34 35 -54 43 -222 l6 -143 -107 0 -106 0 0 133 c0 143 10 199 43 235 30 32 90 30 121 -3z"/>
        			<path d="M6404 1397 c-2 -7 -4 -252 -2 -543 3 -525 3 -529 26 -586 39 -96 106 -138 218 -138 96 0 179 44 237 127 36 50 40 46 52 -50 l7 -57 109 0 109 0 0 630 0 631 -137 -3 -138 -3 -3 -505 -2 -504 -27 -28 c-32 -34 -85 -51 -118 -38 -49 19 -50 21 -55 565 l-5 510 -133 3 c-104 2 -134 0 -138 -11z"/>
        			<path d="M4050 770 l0 -630 140 0 140 0 0 630 0 630 -140 0 -140 0 0 -630z"/>	
				</g>
			</svg>
		</a>
	</div>
	<div class="flex">
		<div
			class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 sm:flex sm:mx-auto sm:items-center lg:w-auto lg:flex lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-6">
			<div class="flex justify-center items-center w-[740px]">
				<form method="GET" class="max-w-[150px] md:max-w-[240px] lg:max-w-[620px] w-full px-4">
					<div class="relative flex items-center">
						<input id="input" type="search" name="search"
							class="w-full bg-primarylightmode dark:bg-[#121212] rounded-3xl py-2 px-4 border border-[#CACACA] dark:border-[#3D3D3D] shadow-sm focus:outline-none text-black dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
							placeholder="Search">
						<button
							class="absolute bg-secondarylightmode dark:bg-secondarydarkmode inset-y-0 right-0 flex items-center px-4 text-black dark:text-white border border-[#CACACA] dark:border-[#3D3D3D] rounded-r-3xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
							<svg class="ml-2 w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
								focusable="false">
								<path
									d="m20.87 20.17-5.59-5.59C16.35 13.35 17 11.75 17 10c0-3.87-3.13-7-7-7s-7 3.13-7 7 3.13 7 7 7c1.75 0 3.35-.65 4.58-1.71l5.59 5.59.7-.71zM10 16c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z">
								</path>
							</svg>
						</button>
					</div>
				</form>
				<button class="bg-secondarylightmode dark:bg-secondarydarkmode p-2.5 rounded-full">
					<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
						<path
							d="M12 3c-1.66 0-3 1.37-3 3.07v5.86c0 1.7 1.34 3.07 3 3.07s3-1.37 3-3.07V6.07C15 4.37 13.66 3 12 3zm6.5 9h-1c0 3.03-2.47 5.5-5.5 5.5S6.5 15.03 6.5 12h-1c0 3.24 2.39 5.93 5.5 6.41V21h2v-2.59c3.11-.48 5.5-3.17 5.5-6.41z">
						</path>
					</svg>
				</button>
			</div>
		</div>
		<button id="small-search-btn" class="mx-0 xs:mx-1 sm:hidden">
			<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
				<path
					d="m20.87 20.17-5.59-5.59C16.35 13.35 17 11.75 17 10c0-3.87-3.13-7-7-7s-7 3.13-7 7 3.13 7 7 7c1.75 0 3.35-.65 4.58-1.71l5.59 5.59.7-.71zM10 16c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z">
				</path>
			</svg>
		</button>
		<button class="mx-1 sm:hidden">
			<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
				<path
					d="M12 3c-1.66 0-3 1.37-3 3.07v5.86c0 1.7 1.34 3.07 3 3.07s3-1.37 3-3.07V6.07C15 4.37 13.66 3 12 3zm6.5 9h-1c0 3.03-2.47 5.5-5.5 5.5S6.5 15.03 6.5 12h-1c0 3.24 2.39 5.93 5.5 6.41V21h2v-2.59c3.11-.48 5.5-3.17 5.5-6.41z">
				</path>
			</svg>
		</button>
		<?php 
			if (isset($_COOKIE['loggedInUser'])) {
				echo '
			<button id="dropdown-button-create" class="mx-1 lg:ml-auto py-2 text-sm transition duration-200" href="#">
				<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24">
					<path
						d="M14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2zm3-7H3v12h14v-6.39l4 1.83V8.56l-4 1.83V6m1-1v3.83L22 7v8l-4-1.83V19H2V5h16z">
					</path>
				</svg>
			</button>
			<button class="mx-1 sm:mx-4 py-2 text-sm transition duration-200" href="#">
				<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
					<path
						d="M10 20h4c0 1.1-.9 2-2 2s-2-.9-2-2zm10-2.65V19H4v-1.65l2-1.88v-5.15C6 7.4 7.56 5.1 10 4.34v-.38c0-1.42 1.49-2.5 2.99-1.76.65.32 1.01 1.03 1.01 1.76v.39c2.44.75 4 3.06 4 5.98v5.15l2 1.87zm-1 .42-2-1.88v-5.47c0-2.47-1.19-4.36-3.13-5.1-1.26-.53-2.64-.5-3.84.03C8.15 6.11 7 7.99 7 10.42v5.47l-2 1.88V18h14v-.23z">
					</path>
				</svg>
			</button>';
			}
		?>
		<button id="dropdown-button">
			<?php 
				if (isset($userData)) {
					echo '<img class="w-7 h-7 sm:w-8 sm:h-8 mx-1 sm:mx-2 my-2 rounded-full"
					src="' . $userData['picture'] . '" alt="user-logo">';
				} else {
					echo '<img class="w-7 h-7 sm:w-8 sm:h-8 mx-1 sm:mx-2 my-2 rounded-full"
					src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="standard-logo">';
				}
			?>
		</button>
	</div>
	<div id="dropdown-menu"
		class="absolute top-3 right-14 sm:right-16 hidden z-10 w-72 bg-secondarylightmode dark:bg-secondarydarkmode rounded-xl w-44">
		<?php
			if (isset($userData)) {
				echo '
				<div class="flex">
				<div class="flex items-center ml-2">
					<img class="w-6 h-6 sm:w-10 sm:h-10 mx-1 sm:mx-2 my-2 rounded-full" src="' . $userData['picture'] . '"
						alt="user-logo">
				</div>
				<div class="px-2 py-3 text-sm text-black dark:text-white">
					<div class="mt-1">' . $userData['username'] . '</div>
					<div class="font-medium mb-2">' . $userData['user_email'] . '</div>
					<button class="font-medium text-blue-400">Manage your account</button>
				</div>
			</div>
			<div class="flex flex-col items-center w-full mt-1 border-t border-gray-600"></div>';
			}
		?>
		<ul class="py-2 text-sm text-black dark:text-white">
			<?php 
				if (isset($userData)) {
					echo '
						<li>
							<a class="flex items-center mx-3" href="#">
								<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
									<path d="M3,3v18h18V3H3z M4.99,20c0.39-2.62,2.38-5.1,7.01-5.1s6.62,2.48,7.01,5.1H4.99z M9,10c0-1.65,1.35-3,3-3s3,1.35,3,3 c0,1.65-1.35,3-3,3S9,11.65,9,10z M12.72,13.93C14.58,13.59,16,11.96,16,10c0-2.21-1.79-4-4-4c-2.21,0-4,1.79-4,4 c0,1.96,1.42,3.59,3.28,3.93c-4.42,0.25-6.84,2.8-7.28,6V4h16v15.93C19.56,16.73,17.14,14.18,12.72,13.93z"></path>
								</svg>
								<p class="block pl-2 py-2">Create a channel</p>
							</a>
						</li>
						<li>
							<a class="flex items-center mx-3" href="#">
								<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
									<path d="M10 9.35 15 12l-5 2.65ZM12 3a.73.73 0 00-.31.06L4.3 7.28a.79.79 0 00-.3.52v8.4a.79.79 0 00.3.52l7.39 4.22a.83.83 0 00.62 0l7.39-4.22a.79.79 0 00.3-.52V7.8a.79.79 0 00-.3-.52l-7.39-4.22A.73.73 0 0012 3m0-1a1.6 1.6 0 01.8.19l7.4 4.22A1.77 1.77 0 0121 7.8v8.4a1.77 1.77 0 01-.8 1.39l-7.4 4.22a1.78 1.78 0 01-1.6 0l-7.4-4.22A1.77 1.77 0 013 16.2V7.8a1.77 1.77 0 01.8-1.39l7.4-4.22A1.6 1.6 0 0112 2Zm0 4a.42.42 0 00-.17 0l-4.7 2.8a.59.59 0 00-.13.39v5.61a.65.65 0 00.13.37l4.7 2.8A.42.42 0 0012 18a.34.34 0 00.17 0l4.7-2.81a.56.56 0 00.13-.39V9.19a.62.62 0 00-.13-.37L12.17 6A.34.34 0 0012 6m0-1a1.44 1.44 0 01.69.17L17.39 8A1.46 1.46 0 0118 9.19v5.61a1.46 1.46 0 01-.61 1.2l-4.7 2.81A1.44 1.44 0 0112 19a1.4 1.4 0 01-.68-.17L6.62 16A1.47 1.47 0 016 14.8V9.19A1.47 1.47 0 016.62 8l4.7-2.8A1.4 1.4 0 0112 5Z"></path>
								</svg>
								<p class="block pl-2 py-2">TimTube studio</p>
							</a>
						</li>
						<li>
							<a class="flex items-center mx-3" href="auth/logout.php">
								<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
									<path d="M20 3v18H8v-1h11V4H8V3h12zm-8.9 12.1.7.7 4.4-4.4L11.8 7l-.7.7 3.1 3.1H3v1h11.3l-3.2 3.3z"></path>
								</svg>
								<p class="block pl-2 py-2">Sign out</p>
							</a>
						</li>
						<li>
							<a class="flex items-center mx-3" href="auth/register.php">
								<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
									<path d="M4 20h14v1H3V6h1v14zM6 3v15h15V3H6zm2.02 14c.36-2.13 1.93-4.1 5.48-4.1s5.12 1.97 5.48 4.1H8.02zM11 8.5a2.5 2.5 0 015 0 2.5 2.5 0 01-5 0zm3.21 3.43A3.507 3.507 0 0017 8.5C17 6.57 15.43 5 13.5 5S10 6.57 10 8.5c0 1.69 1.2 3.1 2.79 3.43-3.48.26-5.4 2.42-5.78 5.07H7V4h13v13h-.01c-.38-2.65-2.31-4.81-5.78-5.07z"></path>
								</svg>
								<p class="block pl-2 py-2">Create account</p>
							</a>
						</li>
						<div class="flex flex-col items-center w-full mt-3 mb-3 border-t border-gray-600"></div>
						<li>
							<a class="flex items-center mx-3" href="#">
								<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
									<path d="M12 3c4.96 0 9 4.04 9 9s-4.04 9-9 9-9-4.04-9-9 4.04-9 9-9m0-1C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4 7V7h-3V5h-2v2h-1c-1.1 0-2 .9-2 2v2c0 1.1.9 2 2 2h4v2H8v2h3v2h2v-2h1c1.1 0 2-.9 2-2v-2c0-1.1-.9-2-2-2h-4V9h6z"></path>
								</svg>
								<p class="block pl-2 py-2">Purchases and memberships</p>
							</a>
						</li>
						<li>
							<a class="flex items-center mx-3" href="#">
								<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
									<path d="m12 3.06 7 3.21v4.84c0 1.3-.25 2.6-.75 3.86-.15.37-.33.76-.55 1.17-.15.27-.31.54-.48.81-1.32 2.01-3.17 3.42-5.23 3.98-2.06-.56-3.91-1.97-5.23-3.98-.17-.27-.33-.54-.48-.81-.22-.41-.4-.79-.55-1.17-.48-1.26-.73-2.56-.73-3.86V6.27l7-3.21m0-1.1L4 5.63v5.49c0 1.47.3 2.9.81 4.22.17.44.37.86.6 1.28.16.3.34.6.52.88 1.42 2.17 3.52 3.82 5.95 4.44l.12.02.12-.03c2.43-.61 4.53-2.26 5.95-4.43.19-.29.36-.58.52-.88.22-.41.43-.84.6-1.28.51-1.33.81-2.76.81-4.23V5.63l-8-3.67zm1.08 10.15c-.32-.06-.64-.11-.96-.12A2.997 2.997 0 0012 6a2.996 2.996 0 00-.12 5.99c-.32.01-.64.06-.96.12C8.64 12.58 7 14.62 7 17h10c0-2.38-1.64-4.42-3.92-4.89zM10 9c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm1.12 4.09c.37-.08.64-.11.88-.11s.51.03.88.11c1.48.3 2.63 1.46 3 2.91H8.12c.37-1.45 1.52-2.61 3-2.91z"></path>
								</svg>
								<p class="block pl-2 py-2">Your data in YouTube</p>
							</a>
						</li>
					';
				} else {
					echo '
						<li>
							<a class="flex items-center mt-1 mx-3" href="auth/login.php">
								<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
									<path d="M20 3v18H8v-1h11V4H8V3h12zm-8.9 12.1.7.7 4.4-4.4L11.8 7l-.7.7 3.1 3.1H3v1h11.3l-3.2 3.3z"></path>
								</svg>
								<p class="block pl-2 py-2">Sign in</p>
							</a>
						</li>
						<li>
							<a class="flex items-center mx-3" href="auth/register.php">
								<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
									<path d="M4 20h14v1H3V6h1v14zM6 3v15h15V3H6zm2.02 14c.36-2.13 1.93-4.1 5.48-4.1s5.12 1.97 5.48 4.1H8.02zM11 8.5a2.5 2.5 0 015 0 2.5 2.5 0 01-5 0zm3.21 3.43A3.507 3.507 0 0017 8.5C17 6.57 15.43 5 13.5 5S10 6.57 10 8.5c0 1.69 1.2 3.1 2.79 3.43-3.48.26-5.4 2.42-5.78 5.07H7V4h13v13h-.01c-.38-2.65-2.31-4.81-5.78-5.07z"></path>
								</svg>
								<p class="block pl-2 py-2">Create account</p>
							</a>
						</li>
					';
				}
			?>
			<div class="flex flex-col items-center w-full mt-3 mb-3 border-t border-gray-600"></div>
			<li>
				<button id="appearance-btn" class="flex items-center mx-3">
					<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
						<path
							d="M12 22C10.93 22 9.86998 21.83 8.83998 21.48L7.41998 21.01L8.83998 20.54C12.53 19.31 15 15.88 15 12C15 8.12 12.53 4.69 8.83998 3.47L7.41998 2.99L8.83998 2.52C9.86998 2.17 10.93 2 12 2C17.51 2 22 6.49 22 12C22 17.51 17.51 22 12 22ZM10.58 20.89C11.05 20.96 11.53 21 12 21C16.96 21 21 16.96 21 12C21 7.04 16.96 3 12 3C11.53 3 11.05 3.04 10.58 3.11C13.88 4.81 16 8.21 16 12C16 15.79 13.88 19.19 10.58 20.89Z">
						</path>
					</svg>
					<p class="block pl-2 py-2">Appearance: <span id="appearance-text"><span></p>
				</button>
			</li>
			<li>
				<a class="flex items-center mx-3" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path
							d="M13.33 6c-1 2.42-2.22 4.65-3.57 6.52l2.98 2.94-.7.71-2.88-2.84c-.53.67-1.06 1.28-1.61 1.83l-3.19 3.19-.71-.71 3.19-3.19c.55-.55 1.08-1.16 1.6-1.83l-.16-.15c-1.11-1.09-1.97-2.44-2.49-3.9l.94-.34c.47 1.32 1.25 2.54 2.25 3.53l.05.05c1.2-1.68 2.29-3.66 3.2-5.81H2V5h6V3h1v2h7v1h-2.67zM22 21h-1l-1.49-4h-5.02L13 21h-1l4-11h2l4 11zm-2.86-5-1.86-5h-.56l-1.86 5h4.28z">
						</path>
					</svg>
					<p class="block pl-2 py-2">Language: English</p>
				</a>
			</li>
			<li>
				<a class="flex items-center mx-3" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
						<path
							d="M12 20.95Q8.975 20.075 6.987 17.312Q5 14.55 5 11.1V5.7L12 3.075L19 5.7V11.35Q18.775 11.275 18.5 11.2Q18.225 11.125 18 11.075V6.375L12 4.15L6 6.375V11.1Q6 12.575 6.438 13.938Q6.875 15.3 7.625 16.438Q8.375 17.575 9.413 18.425Q10.45 19.275 11.625 19.725L11.675 19.7Q11.8 20 11.975 20.288Q12.15 20.575 12.375 20.825Q12.275 20.85 12.188 20.888Q12.1 20.925 12 20.95ZM17 17Q17.625 17 18.062 16.562Q18.5 16.125 18.5 15.5Q18.5 14.875 18.062 14.438Q17.625 14 17 14Q16.375 14 15.938 14.438Q15.5 14.875 15.5 15.5Q15.5 16.125 15.938 16.562Q16.375 17 17 17ZM17 20Q17.8 20 18.438 19.65Q19.075 19.3 19.5 18.7Q18.925 18.35 18.3 18.175Q17.675 18 17 18Q16.325 18 15.7 18.175Q15.075 18.35 14.5 18.7Q14.925 19.3 15.562 19.65Q16.2 20 17 20ZM17 21Q15.325 21 14.163 19.837Q13 18.675 13 17Q13 15.325 14.163 14.162Q15.325 13 17 13Q18.675 13 19.837 14.162Q21 15.325 21 17Q21 18.675 19.837 19.837Q18.675 21 17 21ZM12 11.95Q12 11.95 12 11.95Q12 11.95 12 11.95Q12 11.95 12 11.95Q12 11.95 12 11.95Q12 11.95 12 11.95Q12 11.95 12 11.95Q12 11.95 12 11.95Q12 11.95 12 11.95Q12 11.95 12 11.95Q12 11.95 12 11.95Z">
						</path>
					</svg>
					<p class="block pl-2 py-2">Restricted Mode: Off</p>
				</a>
			</li>
			<li>
				<a class="flex items-center mx-3" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
						<path
							d="M11.99,1.98C6.46,1.98,1.98,6.47,1.98,12s4.48,10.02,10.01,10.02c5.54,0,10.03-4.49,10.03-10.02S17.53,1.98,11.99,1.98z M8.86,14.5c-0.16-0.82-0.25-1.65-0.25-2.5c0-0.87,0.09-1.72,0.26-2.55h6.27c0.17,0.83,0.26,1.68,0.26,2.55 c0,0.85-0.09,1.68-0.25,2.5H8.86z M14.89,15.5c-0.54,1.89-1.52,3.64-2.89,5.15c-1.37-1.5-2.35-3.25-2.89-5.15H14.89z M9.12,8.45 c0.54-1.87,1.52-3.61,2.88-5.1c1.36,1.49,2.34,3.22,2.88,5.1H9.12z M16.15,9.45h4.5c0.24,0.81,0.37,1.66,0.37,2.55 c0,0.87-0.13,1.71-0.36,2.5h-4.51c0.15-0.82,0.24-1.65,0.24-2.5C16.39,11.13,16.3,10.28,16.15,9.45z M20.29,8.45h-4.38 c-0.53-1.97-1.47-3.81-2.83-5.4C16.33,3.45,19.04,5.56,20.29,8.45z M10.92,3.05c-1.35,1.59-2.3,3.43-2.83,5.4H3.71 C4.95,5.55,7.67,3.44,10.92,3.05z M3.35,9.45h4.5C7.7,10.28,7.61,11.13,7.61,12c0,0.85,0.09,1.68,0.24,2.5H3.34 c-0.23-0.79-0.36-1.63-0.36-2.5C2.98,11.11,3.11,10.26,3.35,9.45z M3.69,15.5h4.39c0.52,1.99,1.48,3.85,2.84,5.45 C7.65,20.56,4.92,18.42,3.69,15.5z M13.09,20.95c1.36-1.6,2.32-3.46,2.84-5.45h4.39C19.08,18.42,16.35,20.55,13.09,20.95z">
						</path>
					</svg>
					<p class="block pl-2 py-2">Location: Netherlands</p>
				</a>
			</li>
			<li>
				<a class="flex items-center mx-3" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
						<path
							d="M16 16H8v-2h8v2zm0-5h-2v2h2v-2zm3 0h-2v2h2v-2zm-6 0h-2v2h2v-2zm-3 0H8v2h2v-2zm-3 0H5v2h2v-2zm9-3h-2v2h2V8zm3 0h-2v2h2V8zm-6 0h-2v2h2V8zm-3 0H8v2h2V8zM7 8H5v2h2V8zm15-3v14H2V5h20zm-1 1H3v12h18V6z">
						</path>
					</svg>
					<p class="block pl-2 py-2">Keyboard shortcuts</p>
				</a>
			</li>
			<div class="flex flex-col items-center w-full mt-3 mb-3 border-t border-gray-600"></div>
			<li>
				<a class="flex items-center mx-3" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path
							d="M12 9.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5m0-1c-1.93 0-3.5 1.57-3.5 3.5s1.57 3.5 3.5 3.5 3.5-1.57 3.5-3.5-1.57-3.5-3.5-3.5zM13.22 3l.55 2.2.13.51.5.18c.61.23 1.19.56 1.72.98l.4.32.5-.14 2.17-.62 1.22 2.11-1.63 1.59-.37.36.08.51c.05.32.08.64.08.98s-.03.66-.08.98l-.08.51.37.36 1.63 1.59-1.22 2.11-2.17-.62-.5-.14-.4.32c-.53.43-1.11.76-1.72.98l-.5.18-.13.51-.55 2.24h-2.44l-.55-2.2-.13-.51-.5-.18c-.6-.23-1.18-.56-1.72-.99l-.4-.32-.5.14-2.17.62-1.21-2.12 1.63-1.59.37-.36-.08-.51c-.05-.32-.08-.65-.08-.98s.03-.66.08-.98l.08-.51-.37-.36L3.6 8.56l1.22-2.11 2.17.62.5.14.4-.32c.53-.44 1.11-.77 1.72-.99l.5-.18.13-.51.54-2.21h2.44M14 2h-4l-.74 2.96c-.73.27-1.4.66-2 1.14l-2.92-.83-2 3.46 2.19 2.13c-.06.37-.09.75-.09 1.14s.03.77.09 1.14l-2.19 2.13 2 3.46 2.92-.83c.6.48 1.27.87 2 1.14L10 22h4l.74-2.96c.73-.27 1.4-.66 2-1.14l2.92.83 2-3.46-2.19-2.13c.06-.37.09-.75.09-1.14s-.03-.77-.09-1.14l2.19-2.13-2-3.46-2.92.83c-.6-.48-1.27-.87-2-1.14L14 2z">
						</path>
					</svg>
					<p class="block pl-2 py-2">Settings</p>
				</a>
			</li>
			<div class="flex flex-col items-center w-full mt-3 mb-3 border-t border-gray-600"></div>
			<li>
				<a class="flex items-center mx-3" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path
							d="M15.36 9.96c0 1.09-.67 1.67-1.31 2.24-.53.47-1.03.9-1.16 1.6l-.04.2H11.1l.03-.28c.14-1.17.8-1.76 1.47-2.27.52-.4 1.01-.77 1.01-1.49 0-.51-.23-.97-.63-1.29-.4-.31-.92-.42-1.42-.29-.59.15-1.05.67-1.19 1.34l-.05.28H8.57l.06-.42c.2-1.4 1.15-2.53 2.42-2.87 1.05-.29 2.14-.08 2.98.57.85.64 1.33 1.62 1.33 2.68zM12 18c.55 0 1-.45 1-1s-.45-1-1-1-1 .45-1 1 .45 1 1 1zm0-15c-4.96 0-9 4.04-9 9s4.04 9 9 9 9-4.04 9-9-4.04-9-9-9m0-1c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12 6.48 2 12 2z">
						</path>
					</svg>
					<p class="block pl-2 py-2">Help</p>
				</a>
			</li>
			<li>
				<a class="flex items-center mx-3" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path d="M13 14h-2v-2h2v2zm0-9h-2v6h2V5zm6-2H5v16.59l3.29-3.29.3-.3H19V3m1-1v15H9l-5 5V2h16z">
						</path>
					</svg>
					<p class="block pl-2 py-2">Send feedback</p>
				</a>
			</li>
		</ul>
	</div>
	<div id="dropdown-menu-create"
		class="absolute top-12 right-0 sm:right-0 hidden z-10 bg-secondarylightmode dark:bg-secondarydarkmode rounded-xl w-44">
		<ul class="py-2 text-sm text-black dark:text-white">
			<li>
				<a class="flex items-center mx-3" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path d="m10 8 6 4-6 4V8zm11-5v18H3V3h18zm-1 1H4v16h16V4z"></path>
					</svg>
					<p class="block pl-2 py-2">Upload video</p>
				</a>
			</li>
			<li>
				<a class="flex items-center mx-3" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<g>
							<path
								d="M14 12c0 1.1-.9 2-2 2s-2-.9-2-2 .9-2 2-2 2 .9 2 2zM8.48 8.45l-.71-.7C6.68 8.83 6 10.34 6 12s.68 3.17 1.77 4.25l.71-.71C7.57 14.64 7 13.39 7 12s.57-2.64 1.48-3.55zm7.75-.7-.71.71c.91.9 1.48 2.15 1.48 3.54s-.57 2.64-1.48 3.55l.71.71C17.32 15.17 18 13.66 18 12s-.68-3.17-1.77-4.25zM5.65 5.63l-.7-.71C3.13 6.73 2 9.24 2 12s1.13 5.27 2.95 7.08l.71-.71C4.02 16.74 3 14.49 3 12s1.02-4.74 2.65-6.37zm13.4-.71-.71.71C19.98 7.26 21 9.51 21 12s-1.02 4.74-2.65 6.37l.71.71C20.87 17.27 22 14.76 22 12s-1.13-5.27-2.95-7.08z">
							</path>
						</g>
					</svg>
					<p class="block pl-2 py-2">Go live</p>
				</a>
			</li>
		</ul>
	</div>
</nav>
<div id="small-searchbar-nav" class="hidden sm:hidden fixed top-0 left-0 right-0 w-full flex justify-around items-center py-2 px-4 z-50 bg-primarylightmode dark:bg-primarydarkmode">
	    <button id="close-searchbar-btn">
		    <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
			    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path>
		    </svg>
	    </button>
		<form method="GET" class="max-w-full md:max-w-[240px] lg:max-w-[620px] w-full px-4">
			<div class="relative flex items-center">
				<input id="input" type="search" name="search"
					class="w-full bg-primarylightmode dark:bg-[#121212] rounded-3xl py-2 px-4 border border-[#CACACA] dark:border-[#3D3D3D] shadow-sm focus:outline-none text-black dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
					placeholder="Search">
				<button
					class="absolute bg-secondarylightmode dark:bg-secondarydarkmode inset-y-0 right-0 flex items-center px-4 text-black dark:text-white border border-[#CACACA] dark:border-[#3D3D3D] rounded-r-3xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
					<svg class="ml-1 w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
						focusable="false">
						<path
							d="m20.87 20.17-5.59-5.59C16.35 13.35 17 11.75 17 10c0-3.87-3.13-7-7-7s-7 3.13-7 7 3.13 7 7 7c1.75 0 3.35-.65 4.58-1.71l5.59 5.59.7-.71zM10 16c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z">
						</path>
					</svg>
				</button>
			</div>
		</form>
		<button>
			<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
				<path
					d="M12 3c-1.66 0-3 1.37-3 3.07v5.86c0 1.7 1.34 3.07 3 3.07s3-1.37 3-3.07V6.07C15 4.37 13.66 3 12 3zm6.5 9h-1c0 3.03-2.47 5.5-5.5 5.5S6.5 15.03 6.5 12h-1c0 3.24 2.39 5.93 5.5 6.41V21h2v-2.59c3.11-.48 5.5-3.17 5.5-6.41z">
				</path>
			</svg>
		</button>
</div>
<?php
    // $currentURI = $_SERVER['REQUEST_URI'];
    // $targetScript = '/videoPlayer.php';

    // if (preg_match("~{$targetScript}~i", $currentURI)) {
	// 	echo "werkt";
	// } else {
	// 	echo "werkt niet";
	// }
?>
<div class="navbar-menu relative z-50 hidden">
	<div class="navbar-backdrop fixed inset-0"></div>
	<nav
		class="fixed top-0 left-0 bottom-0 flex flex-col w-[240px] max-w-sm px-4 pt-4 bg-primarylightmode dark:bg-primarydarkmode overflow-y-auto">
		<div class="flex items-center mb-8">
			<button id="hamburger-small-2" class="hover:bg-secondarylightmode dark:hover:bg-secondarydarkmode md:p-2 rounded-full">
				<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
					<path d="M21 6H3V5h18v1zm0 5H3v1h18v-1zm0 6H3v1h18v-1z"></path>
				</svg>
			</button>
			<a class="text-3xl font-bold flex items-center leading-none mx-2 md:mx-1" href="index.php">
				<svg class="ml-0 ml-2 sm:ml-3 w-[90px] external-icon" version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 900.000000 202.000000" preserveAspectRatio="xMidYMid meet">
					<g class="fill-gray-900 dark:fill-white" transform="translate(0.000000,202.000000) scale(0.100000,-0.100000)">
        				<path class="fill-[#FF0000]" d="M1130 2009 c-480 -11 -774 -38 -865 -78 -54 -24 -129 -92 -160 -146 -104 -176 -130 -1018 -45 -1417 28 -131 65 -192 153 -252 29 -19 79 -42 112 -50 301 -76 1883 -79 2214 -5 78 17 130 46 186 103 64 66 87 121 109 261 31 197 39 359 33 673 -10 563 -52 718 -221 817 -24 14 -75 32 -112 40 -114 24 -416 45 -726 50 -161 3 -311 7 -333 8 -22 2 -177 0 -345 -4z m560 -877 c96 -55 183 -107 193 -114 16 -12 1 -23 -145 -108 -483 -278 -574 -330 -580 -330 -9 0 -11 844 -2 852 5 6 78 -35 534 -300z"/>
        				<path d="M7340 1928 c0 -2 -1 -402 -3 -891 l-2 -887 117 0 117 0 11 55 c6 30 14 55 17 55 3 0 21 -17 39 -39 95 -110 288 -120 379 -19 45 49 60 85 88 202 19 82 21 121 21 381 1 315 -11 416 -58 521 -40 87 -122 131 -226 121 -84 -7 -163 -55 -212 -127 -16 -24 -17 -9 -17 303 l-1 327 -135 0 c-74 0 -135 -1 -135 -2z m443 -719 c47 -36 52 -77 52 -419 0 -350 -6 -392 -57 -435 -16 -14 -41 -25 -54 -25 -37 0 -91 26 -103 48 -7 14 -11 145 -11 393 l0 372 44 43 c50 50 87 57 129 23z"/>
        				<path d="M3210 1765 c0 -58 -1 -108 -2 -112 -2 -5 60 -10 137 -13 l140 -5 0 -743 0 -742 138 0 137 0 0 745 0 745 140 0 140 0 0 115 0 115 -415 0 -415 0 0 -105z"/>
        				<path d="M5650 1765 c0 -58 -1 -108 -2 -112 -2 -5 60 -10 137 -13 l140 -5 3 -742 2 -743 135 0 135 0 0 745 0 745 140 0 140 0 0 115 0 115 -415 0 -415 0 0 -105z"/>
        				<path d="M4129 1647 c-68 -45 -76 -123 -18 -171 56 -48 126 -47 173 3 52 54 42 124 -23 168 -43 29 -89 29 -132 0z"/>
        				<path d="M4648 1416 c-62 -23 -85 -43 -112 -99 -43 -87 -49 -187 -42 -702 3 -253 6 -461 6 -463 0 -1 71 -1 158 0 l157 3 5 509 5 508 33 28 c42 35 81 44 104 23 16 -15 18 -57 20 -542 l3 -526 156 -3 156 -2 7 115 c4 64 6 299 5 522 l-2 406 27 19 c32 24 88 27 111 8 38 -31 39 -53 40 -565 l0 -500 136 -3 137 -3 7 133 c4 73 5 313 3 533 -4 350 -7 406 -22 449 -40 111 -94 155 -200 163 -94 8 -166 -16 -226 -76 l-47 -47 -24 37 c-32 52 -87 81 -168 86 -84 6 -116 -6 -119 -43 -3 -36 -8 -40 -29 -22 -65 57 -206 84 -285 54z"/>
        				<path d="M8537 1420 c-102 -18 -174 -73 -218 -165 -55 -114 -64 -182 -64 -480 0 -301 10 -371 66 -484 52 -104 127 -147 270 -158 248 -18 399 104 399 324 l0 63 -43 0 c-24 0 -78 3 -119 6 l-75 7 -7 -62 c-10 -85 -24 -119 -57 -136 -67 -35 -129 -6 -148 69 -6 25 -11 97 -11 160 l0 116 236 0 237 0 -6 223 c-6 241 -15 299 -62 386 -30 55 -82 98 -145 120 -46 16 -192 22 -253 11z m157 -205 c31 -34 35 -54 43 -222 l6 -143 -107 0 -106 0 0 133 c0 143 10 199 43 235 30 32 90 30 121 -3z"/>
        				<path d="M6404 1397 c-2 -7 -4 -252 -2 -543 3 -525 3 -529 26 -586 39 -96 106 -138 218 -138 96 0 179 44 237 127 36 50 40 46 52 -50 l7 -57 109 0 109 0 0 630 0 631 -137 -3 -138 -3 -3 -505 -2 -504 -27 -28 c-32 -34 -85 -51 -118 -38 -49 19 -50 21 -55 565 l-5 510 -133 3 c-104 2 -134 0 -138 -11z"/>
        				<path d="M4050 770 l0 -630 140 0 140 0 0 630 0 630 -140 0 -140 0 0 -630z"/>	
					</g>
				</svg>
			</a>
		</div>
		<div class="text-black dark:text-white">
			<a class="flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="index.php">
				<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
					<g>
						<path d="M4 21V10.08l8-6.96 8 6.96V21h-6v-6h-4v6H4z"></path>
					</g>
				</svg>
				<div class="side-text">
					<span class="ml-6 text-sm">Home</span>
				</div>
			</a>
			<a class="flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
				<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
					<path
						d="M10 14.65v-5.3L15 12l-5 2.65zm7.77-4.33-1.2-.5L18 9.06c1.84-.96 2.53-3.23 1.56-5.06s-3.24-2.53-5.07-1.56L6 6.94c-1.29.68-2.07 2.04-2 3.49.07 1.42.93 2.67 2.22 3.25.03.01 1.2.5 1.2.5L6 14.93c-1.83.97-2.53 3.24-1.56 5.07.97 1.83 3.24 2.53 5.07 1.56l8.5-4.5c1.29-.68 2.06-2.04 1.99-3.49-.07-1.42-.94-2.68-2.23-3.25zm-.23 5.86-8.5 4.5c-1.34.71-3.01.2-3.72-1.14-.71-1.34-.2-3.01 1.14-3.72l2.04-1.08v-1.21l-.69-.28-1.11-.46c-.99-.41-1.65-1.35-1.7-2.41-.05-1.06.52-2.06 1.46-2.56l8.5-4.5c1.34-.71 3.01-.2 3.72 1.14.71 1.34.2 3.01-1.14 3.72L15.5 9.26v1.21l1.8.74c.99.41 1.65 1.35 1.7 2.41.05 1.06-.52 2.06-1.46 2.56z">
					</path>
				</svg>
				<div class="side-text">
					<span class="ml-6 text-sm">Shorts</span>
				</div>
			</a>
			<a class="flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
				<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
					<path d="M10 18v-6l5 3-5 3zm7-15H7v1h10V3zm3 3H4v1h16V6zm2 3H2v12h20V9zM3 10h18v10H3V10z">
					</path>
				</svg>
				<div class="side-text">
					<span class="ml-6 text-sm">Subscriptions</span>
				</div>
			</a>
			<div class="side-text flex flex-col items-center w-full mt-3 mb-3 border-t border-gray-700"></div>
			<a class="flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
				<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
					<path d="m11 7 6 3.5-6 3.5V7zm7 13H4V6H3v15h15v-1zm3-2H6V3h15v15zM7 17h13V4H7v13z"></path>
				</svg>
				<div class="side-text">
					<span class="ml-6 text-sm">Library</span>
				</div>
			</a>
			<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
				<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
					<g>
						<path
							d="M14.97 16.95 10 13.87V7h2v5.76l4.03 2.49-1.06 1.7zM22 12c0 5.51-4.49 10-10 10S2 17.51 2 12h1c0 4.96 4.04 9 9 9s9-4.04 9-9-4.04-9-9-9C8.81 3 5.92 4.64 4.28 7.38c-.11.18-.22.37-.31.56L3.94 8H8v1H1.96V3h1v4.74c.04-.09.07-.17.11-.25.11-.22.23-.42.35-.63C5.22 3.86 8.51 2 12 2c5.51 0 10 4.49 10 10z">
						</path>
					</g>
				</svg>
				<div class="side-text">
					<span class="ml-6 text-sm">History</span>
				</div>
			</a>
			<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
				<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
					<path
						d="M14.97 16.95 10 13.87V7h2v5.76l4.03 2.49-1.06 1.7zM12 3c-4.96 0-9 4.04-9 9s4.04 9 9 9 9-4.04 9-9-4.04-9-9-9m0-1c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12 6.48 2 12 2z">
					</path>
				</svg>
				<div class="side-text">
					<span class="ml-6 text-sm">Watch later</span>
				</div>
			</a>
			<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
				<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
					<path
						d="M18.77,11h-4.23l1.52-4.94C16.38,5.03,15.54,4,14.38,4c-0.58,0-1.14,0.24-1.52,0.65L7,11H3v10h4h1h9.43 c1.06,0,1.98-0.67,2.19-1.61l1.34-6C21.23,12.15,20.18,11,18.77,11z M7,20H4v-8h3V20z M19.98,13.17l-1.34,6 C18.54,19.65,18.03,20,17.43,20H8v-8.61l5.6-6.06C13.79,5.12,14.08,5,14.38,5c0.26,0,0.5,0.11,0.63,0.3 c0.07,0.1,0.15,0.26,0.09,0.47l-1.52,4.94L13.18,12h1.35h4.23c0.41,0,0.8,0.17,1.03,0.46C19.92,12.61,20.05,12.86,19.98,13.17z">
					</path>
				</svg>
				<div class="side-text">
					<span class="ml-6 text-sm">Liked videos</span>
				</div>
			</a>
			<div class="side-text flex flex-col items-center w-full mt-3 border-t border-gray-700">
				<div class="flex items-center w-full py-2 px-3 side-text">
					<p class="mt-2 text-md">Explore</p>
				</div>
				<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path
							d="M19 3.87v9.77C19 17.7 15.86 21 12 21s-7-3.3-7-7.37v-.13c0-1.06.22-2.13.62-3.09.5-1.19 1.29-2.21 2.27-2.97.85-.66 1.83-1.14 2.87-1.65.39-.19.77-.38 1.15-.58.36-.19.72-.38 1.08-.56v3.22l1.55-1.04L19 3.87M20 2l-6 4V3c-.85.44-1.7.88-2.55 1.33-1.41.74-2.9 1.34-4.17 2.32-1.13.87-2.02 2.05-2.58 3.37-.46 1.09-.7 2.29-.7 3.48v.14C4 18.26 7.58 22 12 22s8-3.74 8-8.36V2zM9.45 12.89 14 10v5.7c0 1.82-1.34 3.3-3 3.3s-3-1.47-3-3.3c0-1.19.58-2.23 1.45-2.81z">
						</path>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">Trending</span>
					</div>
				</a>
				<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path
							d="M12 4v9.38c-.73-.84-1.8-1.38-3-1.38-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V8h6V4h-7zM9 19c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm9-12h-5V5h5v2z">
						</path>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">Music</span>
					</div>
				</a>
				<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
						<path
							d="m22.01 4.91-.5-2.96L1.64 5.19 2 8v13h20V8H3.06l18.95-3.09zM5 9l1 3h3L8 9h2l1 3h3l-1-3h2l1 3h3l-1-3h3v11H3V9h2z">
						</path>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">Movies</span>
					</div>
				</a>
				<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path
							d="M10 12H8v2H6v-2H4v-2h2V8h2v2h2v2zm7 .5c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5.67 1.5 1.5 1.5 1.5-.67 1.5-1.5zm3-3c0-.83-.67-1.5-1.5-1.5S17 8.67 17 9.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5zm-3.03-4.35-4.5 2.53-.49.27-.49-.27-4.5-2.53L3 7.39v6.43l8.98 5.04 8.98-5.04V7.39l-3.99-2.24m0-1.15 4.99 2.8v7.6L11.98 20 2 14.4V6.8L6.99 4l4.99 2.8L16.97 4z">
						</path>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">Gaming</span>
					</div>
				</a>
				<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path
							d="M11 11v6H7v-6h4m1-1H6v8h6v-8zM3 3.03V21h14l4-4V3.03M20 4v11.99l-.01.01H16v3.99l-.01.01H4V4h16zm-2 4H6V6h12v2zm0 7h-5v-2h5v2zm0-3h-5v-2h5v2z">
						</path>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">News</span>
					</div>
				</a>
				<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
						<path
							d="M18 5V2H6v3H3v6l3.23 1.61c.7 2.5 2.97 4.34 5.69 4.38L8 19v3h8v-3l-3.92-2.01c2.72-.04 4.99-1.88 5.69-4.38L21 11V5h-3zM6 11.38l-2-1V6h2v5.38zM15 21H9v-1.39l3-1.54 3 1.54V21zm2-10c0 2.76-2.24 5-5 5s-5-2.24-5-5V3h10v8zm3-.62-2 1V6h2v4.38z">
						</path>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">Sports</span>
					</div>
				</a>
			</div>
			<div class="side-text flex flex-col items-center w-full mt-3 border-t border-gray-700">
				<div class="flex items-center w-full py-2 px-3 side-text">
					<p class="mt-2 text-md">More from YouTube</p>
				</div>
				<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 97 20" focusable="false">
						<svg viewBox="0 0 97 20" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
							<g>
								<path
									d="M27.9704 3.12324C27.6411 1.89323 26.6745 0.926623 25.4445 0.597366C23.2173 2.24288e-07 14.2827 0 14.2827 0C14.2827 0 5.34807 2.24288e-07 3.12088 0.597366C1.89323 0.926623 0.924271 1.89323 0.595014 3.12324C-2.8036e-07 5.35042 0 10 0 10C0 10 -1.57002e-06 14.6496 0.597364 16.8768C0.926621 18.1068 1.89323 19.0734 3.12324 19.4026C5.35042 20 14.285 20 14.285 20C14.285 20 23.2197 20 25.4468 19.4026C26.6769 19.0734 27.6435 18.1068 27.9727 16.8768C28.5701 14.6496 28.5701 10 28.5701 10C28.5701 10 28.5677 5.35042 27.9704 3.12324Z"
									fill="#FF0000"></path>
								<path class="fill-white" d="M11.4275 14.2854L18.8475 10.0004L11.4275 5.71533V14.2854Z"></path>
							</g>
							<g>
								<path
									d="M40.0566 6.34524V7.03668C40.0566 10.4915 38.5255 12.5118 35.1742 12.5118H34.6638V18.5583H31.9263V1.42285H35.414C38.6078 1.42285 40.0566 2.7728 40.0566 6.34524ZM37.1779 6.59218C37.1779 4.09924 36.7287 3.50658 35.1765 3.50658H34.6662V10.4727H35.1365C36.6064 10.4727 37.1803 9.40968 37.1803 7.10253L37.1779 6.59218Z">
								</path>
								<path
									d="M46.5336 5.8345L46.3901 9.08238C45.2259 8.83779 44.264 9.02123 43.836 9.77382V18.5579H41.1196V6.0391H43.2857L43.5303 8.75312H43.6337C43.9183 6.77288 44.8379 5.771 46.0232 5.771C46.1949 5.7757 46.3666 5.79687 46.5336 5.8345Z">
								</path>
								<path
									d="M49.6567 13.2456V13.8782C49.6567 16.0842 49.779 16.8415 50.7198 16.8415C51.6182 16.8415 51.8228 16.1501 51.8439 14.7178L54.2734 14.8613C54.4568 17.5565 53.0481 18.763 50.6586 18.763C47.7588 18.763 46.9004 16.8627 46.9004 13.4126V11.223C46.9004 7.58707 47.8599 5.80908 50.7409 5.80908C53.6407 5.80908 54.3769 7.32131 54.3769 11.0984V13.2456H49.6567ZM49.6567 10.6703V11.5687H51.7193V10.675C51.7193 8.37258 51.5547 7.71172 50.6821 7.71172C49.8096 7.71172 49.6567 8.38669 49.6567 10.675V10.6703Z">
								</path>
								<path
									d="M68.4103 9.09902V18.5557H65.5928V9.30834C65.5928 8.28764 65.327 7.77729 64.7132 7.77729C64.2216 7.77729 63.7724 8.06186 63.4667 8.59338C63.4832 8.76271 63.4902 8.93439 63.4879 9.10373V18.5605H60.668V9.30834C60.668 8.28764 60.4022 7.77729 59.7884 7.77729C59.2969 7.77729 58.8665 8.06186 58.5631 8.57456V18.5628H55.7456V6.03929H57.9728L58.2221 7.63383H58.2621C58.8947 6.42969 59.9178 5.77588 61.1219 5.77588C62.3072 5.77588 62.9799 6.36854 63.288 7.43157C63.9418 6.34973 64.9225 5.77588 66.0443 5.77588C67.7564 5.77588 68.4103 7.00119 68.4103 9.09902Z">
								</path>
								<path
									d="M69.8191 2.8338C69.8191 1.4862 70.3106 1.09814 71.3501 1.09814C72.4132 1.09814 72.8812 1.54734 72.8812 2.8338C72.8812 4.22373 72.4108 4.57181 71.3501 4.57181C70.3106 4.56945 69.8191 4.22138 69.8191 2.8338ZM69.9837 6.03935H72.6789V18.5629H69.9837V6.03935Z">
								</path>
								<path
									d="M81.891 6.03955V18.5631H79.6849L79.4403 17.032H79.3792C78.7466 18.2573 77.827 18.7677 76.684 18.7677C75.0095 18.7677 74.2522 17.7046 74.2522 15.3975V6.0419H77.0697V15.2352C77.0697 16.3382 77.3002 16.7874 77.867 16.7874C78.3844 16.7663 78.8477 16.4582 79.0688 15.9902V6.0419H81.891V6.03955Z">
								</path>
								<path
									d="M96.1901 9.09893V18.5557H93.3726V9.30825C93.3726 8.28755 93.1068 7.7772 92.493 7.7772C92.0015 7.7772 91.5523 8.06177 91.2465 8.59329C91.263 8.76027 91.2701 8.9296 91.2677 9.09893V18.5557H88.4502V9.30825C88.4502 8.28755 88.1845 7.7772 87.5706 7.7772C87.0791 7.7772 86.6487 8.06177 86.3453 8.57447V18.5627H83.5278V6.0392H85.7527L85.9973 7.63139H86.0372C86.6699 6.42725 87.6929 5.77344 88.8971 5.77344C90.0824 5.77344 90.755 6.3661 91.0631 7.42913C91.7169 6.34729 92.6976 5.77344 93.8194 5.77344C95.541 5.77579 96.1901 7.0011 96.1901 9.09893Z">
								</path>
								<path
									d="M40.0566 6.34524V7.03668C40.0566 10.4915 38.5255 12.5118 35.1742 12.5118H34.6638V18.5583H31.9263V1.42285H35.414C38.6078 1.42285 40.0566 2.7728 40.0566 6.34524ZM37.1779 6.59218C37.1779 4.09924 36.7287 3.50658 35.1765 3.50658H34.6662V10.4727H35.1365C36.6064 10.4727 37.1803 9.40968 37.1803 7.10253L37.1779 6.59218Z">
								</path>
							</g>
						</svg>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">TimTube Premium</span>
					</div>
				</a>
				<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
						<circle fill="#FF0000" cx="12" cy="12" r="10"></circle>
						<polygon fill="#FFFFFF" points="10,14.65 10,9.35 15,12"></polygon>
						<path fill="#FFFFFF"
							d="M12,7c2.76,0,5,2.24,5,5s-2.24,5-5,5s-5-2.24-5-5S9.24,7,12,7 M12,6c-3.31,0-6,2.69-6,6s2.69,6,6,6s6-2.69,6-6 S15.31,6,12,6L12,6z">
						</path>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">TimTube Music</span>
					</div>
				</a>
				<a class="side-text flex items-center w-full py-2 px-3 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
						<path fill="#FF0000"
							d="M21.39,13.19c0-0.08,0-0.15,0-0.22c-0.01-0.86-0.5-5-0.78-5.74c-0.32-0.85-0.76-1.5-1.31-1.91 c-0.9-0.67-1.66-0.82-2.6-0.84l-0.02,0c-0.4,0-3.01,0.32-5.2,0.62C9.28,5.4,6.53,5.8,5.88,6.04c-0.9,0.33-1.62,0.77-2.19,1.33 c-1.05,1.04-1.18,2.11-1.04,3.51c0.1,1.09,0.69,5.37,1.02,6.35c0.45,1.32,1.33,2.12,2.47,2.24c0.28,0.03,0.55,0.05,0.82,0.05 c1,0,1.8-0.21,2.72-0.46c1.45-0.39,3.25-0.87,6.97-0.87l0.09,0h0.02c0.91,0,3.14-0.2,4.16-2.07C21.44,15.12,21.41,13.91,21.39,13.19 z">
						</path>
						<path fill="#000"
							d="M21.99,13.26c0-0.08,0-0.16-0.01-0.24c-0.01-0.92-0.54-5.32-0.83-6.11c-0.34-0.91-0.81-1.59-1.4-2.03 C18.81,4.17,17.99,4.02,17,4l-0.02,0c-0.43,0-3.21,0.34-5.54,0.66c-2.33,0.32-5.25,0.75-5.95,1C4.53,6.01,3.76,6.48,3.16,7.08 c-1.12,1.1-1.25,2.25-1.11,3.74c0.11,1.16,0.73,5.71,1.08,6.75c0.48,1.41,1.41,2.25,2.63,2.38C6.06,19.98,6.34,20,6.63,20 c1.07,0,1.91-0.23,2.89-0.49c1.54-0.41,3.46-0.93,7.41-0.93l0.1,0h0.02c0.97,0,3.34-0.21,4.42-2.2 C22.04,15.32,22.01,14.03,21.99,13.26z M20.59,15.91c-0.82,1.51-2.75,1.68-3.56,1.68l-0.1,0c-4.09,0-6.07,0.53-7.67,0.96 C8.31,18.8,7.56,19,6.63,19c-0.25,0-0.5-0.01-0.76-0.04c-1.04-0.11-1.54-0.99-1.79-1.71c-0.3-0.88-0.91-5.21-1.04-6.53 C2.9,9.25,3.1,8.54,3.86,7.79c0.5-0.5,1.15-0.89,1.97-1.19c0.17-0.06,1.1-0.32,5.74-0.95C14.2,5.29,16.64,5.01,16.99,5 c0.83,0.02,1.43,0.13,2.17,0.69c0.43,0.32,0.79,0.86,1.06,1.58c0.22,0.58,0.76,4.78,0.77,5.77l0.01,0.25 C21.01,13.96,21.04,15.08,20.59,15.91z">
						</path>
						<path fill="#000"
							d="M11.59,14.76c-0.48,0.36-0.8,0.45-1.01,0.45c-0.16,0-0.25-0.05-0.3-0.08c-0.34-0.18-0.42-0.61-0.5-1.2l-0.01-0.1 c-0.04-0.31-0.26-2.1-0.38-3.16L9.3,9.94C9.26,9.66,9.2,9.19,9.54,8.94c0.32-0.23,0.75-0.09,0.96-0.03c0.53,0.17,3.6,1.23,4.59,1.73 c0.21,0.09,0.67,0.28,0.68,0.83c0.01,0.5-0.38,0.74-0.53,0.82L11.59,14.76z">
						</path>
						<path fill="#FFF"
							d="M10.3,9.89c0,0,0.5,4.08,0.51,4.19c0.06-0.04,3.79-2.58,3.79-2.58C13.71,11.07,11.07,10.14,10.3,9.89z">
						</path>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">TimTube Kids</span>
					</div>
				</a>
			</div>
			<div class="side-text flex flex-col items-center w-full mt-2 border-t border-gray-700">
				<a class="flex items-center w-full py-2 px-3 mt-2 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path
							d="M12 9.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5m0-1c-1.93 0-3.5 1.57-3.5 3.5s1.57 3.5 3.5 3.5 3.5-1.57 3.5-3.5-1.57-3.5-3.5-3.5zM13.22 3l.55 2.2.13.51.5.18c.61.23 1.19.56 1.72.98l.4.32.5-.14 2.17-.62 1.22 2.11-1.63 1.59-.37.36.08.51c.05.32.08.64.08.98s-.03.66-.08.98l-.08.51.37.36 1.63 1.59-1.22 2.11-2.17-.62-.5-.14-.4.32c-.53.43-1.11.76-1.72.98l-.5.18-.13.51-.55 2.24h-2.44l-.55-2.2-.13-.51-.5-.18c-.6-.23-1.18-.56-1.72-.99l-.4-.32-.5.14-2.17.62-1.21-2.12 1.63-1.59.37-.36-.08-.51c-.05-.32-.08-.65-.08-.98s.03-.66.08-.98l.08-.51-.37-.36L3.6 8.56l1.22-2.11 2.17.62.5.14.4-.32c.53-.44 1.11-.77 1.72-.99l.5-.18.13-.51.54-2.21h2.44M14 2h-4l-.74 2.96c-.73.27-1.4.66-2 1.14l-2.92-.83-2 3.46 2.19 2.13c-.06.37-.09.75-.09 1.14s.03.77.09 1.14l-2.19 2.13 2 3.46 2.92-.83c.6.48 1.27.87 2 1.14L10 22h4l.74-2.96c.73-.27 1.4-.66 2-1.14l2.92.83 2-3.46-2.19-2.13c.06-.37.09-.75.09-1.14s-.03-.77-.09-1.14l2.19-2.13-2-3.46-2.92.83c-.6-.48-1.27-.87-2-1.14L14 2z">
						</path>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">Settings</span>
					</div>
				</a>
				<a class="side-text flex items-center w-full py-2 px-3 mt-2 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<g>
							<path d="M14 3H5v18h1v-9h6.6l.4 2h7V5h-5.6L14 3z"></path>
						</g>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">Report history</span>
					</div>
				</a>
				<a class="side-text flex items-center w-full py-2 px-3 mt-2 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path
							d="M15.36 9.96c0 1.09-.67 1.67-1.31 2.24-.53.47-1.03.9-1.16 1.6l-.04.2H11.1l.03-.28c.14-1.17.8-1.76 1.47-2.27.52-.4 1.01-.77 1.01-1.49 0-.51-.23-.97-.63-1.29-.4-.31-.92-.42-1.42-.29-.59.15-1.05.67-1.19 1.34l-.05.28H8.57l.06-.42c.2-1.4 1.15-2.53 2.42-2.87 1.05-.29 2.14-.08 2.98.57.85.64 1.33 1.62 1.33 2.68zM12 18c.55 0 1-.45 1-1s-.45-1-1-1-1 .45-1 1 .45 1 1 1zm0-15c-4.96 0-9 4.04-9 9s4.04 9 9 9 9-4.04 9-9-4.04-9-9-9m0-1c5.52 0 10 4.48 10 10s-4.48 10-10 10S2 17.52 2 12 6.48 2 12 2z">
						</path>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">Help</span>
					</div>
				</a>
				<a class="side-text flex items-center w-full py-2 px-3 mt-2 rounded-xl hover:bg-secondarylightmode dark:hover:bg-[#272727]" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24" focusable="false">
						<path d="M13 14h-2v-2h2v2zm0-9h-2v6h2V5zm6-2H5v16.59l3.29-3.29.3-.3H19V3m1-1v15H9l-5 5V2h16z">
						</path>
					</svg>
					<div class="side-text">
						<span class="ml-6 text-sm">Send feedback</span>
					</div>
				</a>
			</div>
		</div>
	</nav>
</div>