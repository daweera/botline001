router.route("/https://02f5-2001-44c8-4280-6979-f1c1-c916-54f0-1444.ap.ngrok.io")
    .get((req, res) => {
        if (req.isAuthenticated()) {
            return res.json({ message: "Welcome " });
        }
        res.sendStatus(401); //you are not allowed!
    });