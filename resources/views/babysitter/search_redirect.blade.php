<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>找保母</title>
</head>
<body>

<script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
<script>
    function initializeLiff(myLiffId) {
        liff.init({ liffId: myLiffId })
            .then(() => {
                if (liff.isLoggedIn()) {
                    getUserProfile();
                } else {
                    liff.login();
                }
            })
            .catch(err => {
                console.error('LIFF Initialization failed', err);
            });
    }

    function getUserProfile() {
        liff.getProfile()
            .then(profile => {
                window.location = '/babysitter/search/search?userId='+profile.userId+'&name='+profile.displayName;
            })
            .catch(err => {
                console.error('Error getting profile', err);
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const myLiffId = '2007365251-okgPA6K0'; // Replace with your LIFF ID
        initializeLiff(myLiffId);
    });
</script>

</body>
</html>
