# BRD_QuickAddCart

![Screenshot](docs/BRD_QuickAddCart.png)

Magento 2.x module designed to enable the user to search for products by Name, SKU, UPC or Product ID in an instantly-returned form. The extension is roughly 70-75% complete based on this [user story](docs/BRD_Quick_Add_to_Cart.pdf).

## How It Works
Based on the requirements, the developer's interpreted approach was to go with a page accessible via custom router which could eventually be modularized into a layout block and injected into other pages. Upon entering a keyword or keywords beyond 3 characters, the search utilizes an AJAX call to return a barebones product grid and updates these results as the user types.

## How to Access
Admin: **Admin > System Configuration > Quick Add To Cart.** (Default and Website views)

Frontend: `[store_domain]/quickaddcart`

# Installation
Create/edit a `composer.json` with the following config:
```json
{
    "require": {
        "kegdev/brd_quickaddcart": "dev-master"
    },
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/kegdev/BRD_QuickAddCart"
        }
    ]
}
```
In the latest version of Magento (2.3.5 tested), you will need to add a qualifier to the repository to meet composer requirements:

```json
{
    "repositories": [
        "module-brd-quickaddcart": {
            "type": "git",
            "url": "https://github.com/kegdev/BRD_QuickAddCart"
        }
    ]
}
```

Run `composer update` or `composer require kegdev/brd_quickaddcart:dev-master` in your terminal while in the webroot.

## ToDo Items
* Add some `less` files to enable modularization of color schemes across website views.
* Add a loading animation image - currently it renders as text.
* Correct issue with Price rendering on product (it is an issue with a pricing layout inheritance).
* Add conditional to disable Add To Cart on grid. Helper and block call are in place but the `Magento_Catalog` template needs to be extended and/or edited.
* Add API endpoints for model functions that power the product collection build.
* Unit Tests.
