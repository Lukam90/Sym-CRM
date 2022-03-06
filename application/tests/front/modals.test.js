const puppeteer = require("puppeteer");

test("should open mentions modal", async () => {
    const browser = await puppeteer.launch({
        headless: true
    });

    const page = await browser.newPage();

    await page.goto("/");
    await page.click("a#mentions-link");

    //const modal = await page.$eval(".is-active", el => el.textContent);

    //expect(modal).toBe(".is-active");
});