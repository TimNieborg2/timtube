<?php 

require_once("./config/database.inc.php");

if (isset($_SESSION['loggedInAdmin'])) {
    $userID = $_SESSION['loggedInAdmin'];

    $query = "SELECT * FROM users WHERE id = :adminid";

    $statement = $conn->prepare($query);
    $statement->bindParam(':adminid', $userID);
    $statement->execute();

    if ($statement->rowCount() === 1) {
        $userData = $statement->fetch(PDO::FETCH_ASSOC);
    } else {
        $userData = false;
    }
} 

?>

<nav
	class="fixed top-0 left-0 right-0 z-40 px-4 py-1 flex justify-between items-center bg-primarylightmode dark:bg-primarydarkmode">
	<div class="flex">
		<button id="hamburger-big-admin"
			class="hover:bg-secondarylightmode dark:hover:bg-secondarydarkmode md:p-2 rounded-full">
			<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
				<path d="M21 6H3V5h18v1zm0 5H3v1h18v-1zm0 6H3v1h18v-1z"></path>
			</svg>
		</button>
		<!-- <button id="hamburger-small"
			class="sm:hidden hover:bg-secondarylightmode dark:hover:bg-secondarydarkmode md:p-2 rounded-full">
			<svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24" focusable="false">
				<path d="M21 6H3V5h18v1zm0 5H3v1h18v-1zm0 6H3v1h18v-1z"></path>
			</svg>
		</button> -->
		<a class="text-3xl font-bold flex items-center leading-none mx-2 md:mx-1" href="admin.php">
			<svg class="ml-0 ml-2 sm:ml-3 w-[90px] external-icon" version="1.0" xmlns="http://www.w3.org/2000/svg"
				viewBox="0 0 900.000000 202.000000" preserveAspectRatio="xMidYMid meet">
				<g class="fill-gray-900 dark:fill-white"
					transform="translate(0.000000,202.000000) scale(0.100000,-0.100000)">
					<path class="fill-[#FF0000]"
						d="M1130 2009 c-480 -11 -774 -38 -865 -78 -54 -24 -129 -92 -160 -146 -104 -176 -130 -1018 -45 -1417 28 -131 65 -192 153 -252 29 -19 79 -42 112 -50 301 -76 1883 -79 2214 -5 78 17 130 46 186 103 64 66 87 121 109 261 31 197 39 359 33 673 -10 563 -52 718 -221 817 -24 14 -75 32 -112 40 -114 24 -416 45 -726 50 -161 3 -311 7 -333 8 -22 2 -177 0 -345 -4z m560 -877 c96 -55 183 -107 193 -114 16 -12 1 -23 -145 -108 -483 -278 -574 -330 -580 -330 -9 0 -11 844 -2 852 5 6 78 -35 534 -300z" />
					<path
						d="M7340 1928 c0 -2 -1 -402 -3 -891 l-2 -887 117 0 117 0 11 55 c6 30 14 55 17 55 3 0 21 -17 39 -39 95 -110 288 -120 379 -19 45 49 60 85 88 202 19 82 21 121 21 381 1 315 -11 416 -58 521 -40 87 -122 131 -226 121 -84 -7 -163 -55 -212 -127 -16 -24 -17 -9 -17 303 l-1 327 -135 0 c-74 0 -135 -1 -135 -2z m443 -719 c47 -36 52 -77 52 -419 0 -350 -6 -392 -57 -435 -16 -14 -41 -25 -54 -25 -37 0 -91 26 -103 48 -7 14 -11 145 -11 393 l0 372 44 43 c50 50 87 57 129 23z" />
					<path
						d="M3210 1765 c0 -58 -1 -108 -2 -112 -2 -5 60 -10 137 -13 l140 -5 0 -743 0 -742 138 0 137 0 0 745 0 745 140 0 140 0 0 115 0 115 -415 0 -415 0 0 -105z" />
					<path
						d="M5650 1765 c0 -58 -1 -108 -2 -112 -2 -5 60 -10 137 -13 l140 -5 3 -742 2 -743 135 0 135 0 0 745 0 745 140 0 140 0 0 115 0 115 -415 0 -415 0 0 -105z" />
					<path
						d="M4129 1647 c-68 -45 -76 -123 -18 -171 56 -48 126 -47 173 3 52 54 42 124 -23 168 -43 29 -89 29 -132 0z" />
					<path
						d="M4648 1416 c-62 -23 -85 -43 -112 -99 -43 -87 -49 -187 -42 -702 3 -253 6 -461 6 -463 0 -1 71 -1 158 0 l157 3 5 509 5 508 33 28 c42 35 81 44 104 23 16 -15 18 -57 20 -542 l3 -526 156 -3 156 -2 7 115 c4 64 6 299 5 522 l-2 406 27 19 c32 24 88 27 111 8 38 -31 39 -53 40 -565 l0 -500 136 -3 137 -3 7 133 c4 73 5 313 3 533 -4 350 -7 406 -22 449 -40 111 -94 155 -200 163 -94 8 -166 -16 -226 -76 l-47 -47 -24 37 c-32 52 -87 81 -168 86 -84 6 -116 -6 -119 -43 -3 -36 -8 -40 -29 -22 -65 57 -206 84 -285 54z" />
					<path
						d="M8537 1420 c-102 -18 -174 -73 -218 -165 -55 -114 -64 -182 -64 -480 0 -301 10 -371 66 -484 52 -104 127 -147 270 -158 248 -18 399 104 399 324 l0 63 -43 0 c-24 0 -78 3 -119 6 l-75 7 -7 -62 c-10 -85 -24 -119 -57 -136 -67 -35 -129 -6 -148 69 -6 25 -11 97 -11 160 l0 116 236 0 237 0 -6 223 c-6 241 -15 299 -62 386 -30 55 -82 98 -145 120 -46 16 -192 22 -253 11z m157 -205 c31 -34 35 -54 43 -222 l6 -143 -107 0 -106 0 0 133 c0 143 10 199 43 235 30 32 90 30 121 -3z" />
					<path
						d="M6404 1397 c-2 -7 -4 -252 -2 -543 3 -525 3 -529 26 -586 39 -96 106 -138 218 -138 96 0 179 44 237 127 36 50 40 46 52 -50 l7 -57 109 0 109 0 0 630 0 631 -137 -3 -138 -3 -3 -505 -2 -504 -27 -28 c-32 -34 -85 -51 -118 -38 -49 19 -50 21 -55 565 l-5 510 -133 3 c-104 2 -134 0 -138 -11z" />
					<path d="M4050 770 l0 -630 140 0 140 0 0 630 0 630 -140 0 -140 0 0 -630z" />
				</g>
			</svg>
			<span class="ml-2 pt-1 text-base font-light text-secondarylightmode dark:text-white">Admin</span>
		</a>
	</div>
	<div class="flex">
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
					<a class="font-medium text-blue-400" href="">Manage your Google account</a>
				</div>
			</div>
			<div class="flex flex-col items-center w-full mt-1 border-t border-gray-600"></div>';
			}
		?>
		<ul class="py-2 text-sm text-black dark:text-white">
			<li>
				<a class="flex items-center mt-1 mx-3" href="../logout.php">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24"
						viewBox="0 0 24 24" focusable="false">
						<path
							d="M20 3v18H8v-1h11V4H8V3h12zm-8.9 12.1.7.7 4.4-4.4L11.8 7l-.7.7 3.1 3.1H3v1h11.3l-3.2 3.3z">
						</path>
					</svg>
					<p class="block pl-2 py-2">Logout</p>
				</a>
			</li>
			<li>
				<a class="flex items-center mx-3" href="./index.php">
					<svg class="w-6 h-6 fill-black dark:fill-white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve">
						<g
							transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
							<path
								d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 24.813 0 45 20.187 45 45 C 90 69.813 69.813 90 45 90 z M 45 4 C 22.393 4 4 22.393 4 45 s 18.393 41 41 41 s 41 -18.393 41 -41 S 67.607 4 45 4 z"
								transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
							<path
								d="M 34.054 65.546 c -0.775 0 -1.551 -0.204 -2.257 -0.611 c -1.414 -0.816 -2.257 -2.278 -2.257 -3.91 V 28.975 c 0 -1.632 0.844 -3.093 2.257 -3.909 c 1.413 -0.816 3.101 -0.816 4.515 0 L 64.067 41.09 c 1.413 0.816 2.257 2.278 2.257 3.91 s -0.844 3.094 -2.257 3.91 l 0 0 L 36.311 64.935 C 35.604 65.342 34.829 65.546 34.054 65.546 z M 34.054 28.457 c -0.103 0 -0.191 0.034 -0.258 0.073 c -0.117 0.068 -0.257 0.2 -0.257 0.445 v 32.049 c 0 0.245 0.14 0.378 0.257 0.445 c 0.117 0.069 0.301 0.124 0.514 0 l 27.756 -16.024 c 0.212 -0.123 0.257 -0.31 0.257 -0.446 s -0.045 -0.323 -0.257 -0.446 L 34.311 28.53 C 34.219 28.477 34.133 28.457 34.054 28.457 z M 63.067 47.178 h 0.01 H 63.067 z"
								transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
						</g>
					</svg>
					<p class="block pl-2 py-2">Back to TimTube</p>
				</a>
			</li>
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
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24"
						viewBox="0 0 24 24" focusable="false">
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
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24"
						viewBox="0 0 24 24" focusable="false">
						<path
							d="M12 9.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5m0-1c-1.93 0-3.5 1.57-3.5 3.5s1.57 3.5 3.5 3.5 3.5-1.57 3.5-3.5-1.57-3.5-3.5-3.5zM13.22 3l.55 2.2.13.51.5.18c.61.23 1.19.56 1.72.98l.4.32.5-.14 2.17-.62 1.22 2.11-1.63 1.59-.37.36.08.51c.05.32.08.64.08.98s-.03.66-.08.98l-.08.51.37.36 1.63 1.59-1.22 2.11-2.17-.62-.5-.14-.4.32c-.53.43-1.11.76-1.72.98l-.5.18-.13.51-.55 2.24h-2.44l-.55-2.2-.13-.51-.5-.18c-.6-.23-1.18-.56-1.72-.99l-.4-.32-.5.14-2.17.62-1.21-2.12 1.63-1.59.37-.36-.08-.51c-.05-.32-.08-.65-.08-.98s.03-.66.08-.98l.08-.51-.37-.36L3.6 8.56l1.22-2.11 2.17.62.5.14.4-.32c.53-.44 1.11-.77 1.72-.99l.5-.18.13-.51.54-2.21h2.44M14 2h-4l-.74 2.96c-.73.27-1.4.66-2 1.14l-2.92-.83-2 3.46 2.19 2.13c-.06.37-.09.75-.09 1.14s.03.77.09 1.14l-2.19 2.13 2 3.46 2.92-.83c.6.48 1.27.87 2 1.14L10 22h4l.74-2.96c.73-.27 1.4-.66 2-1.14l2.92.83 2-3.46-2.19-2.13c.06-.37.09-.75.09-1.14s-.03-.77-.09-1.14l2.19-2.13-2-3.46-2.92.83c-.6-.48-1.27-.87-2-1.14L14 2z">
						</path>
					</svg>
					<p class="block pl-2 py-2">Settings</p>
				</a>
			</li>
		</ul>
	</div>
	<div id="dropdown-menu-create"
		class="absolute top-12 right-0 sm:right-0 hidden z-10 bg-secondarylightmode dark:bg-secondarydarkmode rounded-xl w-44">
		<ul class="py-2 text-sm text-black dark:text-white">
			<li>
				<a class="flex items-center mx-3" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24"
						viewBox="0 0 24 24" focusable="false">
						<path d="m10 8 6 4-6 4V8zm11-5v18H3V3h18zm-1 1H4v16h16V4z"></path>
					</svg>
					<p class="block pl-2 py-2">Upload video</p>
				</a>
			</li>
			<li>
				<a class="flex items-center mx-3" href="#">
					<svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24"
						viewBox="0 0 24 24" focusable="false">
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
<div id="small-searchbar-nav"
	class="hidden sm:hidden fixed top-0 left-0 right-0 w-full flex justify-around items-center py-2 px-4 z-50 bg-primarylightmode dark:bg-primarydarkmode">
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
				<svg class="ml-1 w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24"
					viewBox="0 0 24 24" focusable="false">
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