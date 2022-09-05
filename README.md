# Small business regulation bundle for Kimai
This Kimai plugin provides a function that makes it easy to use the small business regulation as it can be used in Germany and Austria.

## Features
* Adds a setting to enable the small business regulation globally.
* Disables VAT calculation for all invoices.
* Hides VAT in all default invoices.
* Adds a note to the invoice that the small business regulation is used.

## Requirements
This plugin is compatible with the following Kimai releases:

| Bundle version   | Minimum Kimai version |
|------------------|-----------------------|
| 1.0              | 1.24                  |

## Installation
First clone this repository to your Kimai installation `plugins` directory:

```bash
cd var/plugins/
git clone https://github.com/LiaraAlis/kimai2-SmallBusinessRuleBundle.git SmallBusinessRuleBundle
```

Now you need to rebuild the cache, and you're ready to go!

```bash
bin/console kimai:reload --env=prod
```

To enable the small business regulation, go to the system settings and enable the checkbox in section `Invoices`. From now on, small business regulation is applied on all your invoices.
