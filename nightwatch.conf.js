module.exports = {
	src_folders: ["tests/Front"],
	//page_objects_path: ["page-objects"],
	webdriver: {
		start_process : true,
		server_path : "node_modules/.bin/chromedriver",
		host: "localhost",
		port : 4444
	},
	test_settings: {
		default: {
			desiredCapabilities: {
				browserName : 'chrome',
				javascriptEnabled: true,
				acceptSslCerts: true,
				chromeOptions: {
					args: ["headless", "no-sandbox", "disable-gpu"]
				}
			},
		},
	},
};