## ITholics - Module: Delete temporary files
**Composer:** *ith_modules/clear_template*

**ModuleID:** *ith_clear_tmp*

### Requirements
- OXID EE/PE/CE ^6.2
- PHP ^7.1


### Features
- Item in the admin menu to delete the cache (temporary directory)
    - All files beginning with 'o' and 'c' are deleted,
        and the complete contents of the 'Smarty' directory.
    - If the PHP method is activated, all non-hidden files in the root tmp directory are deleted,
        as well as everything in the smarty directory.
- button in the header line of the admin panel
    - Cache is cleared (optical feedback).
- On the store page you can optionally use hotkeys to delete the cache
  can be pressed
    - The cache is cleared and the page is reloaded.
    - This feature must be enabled in the module settings.
    - Furthermore, an IP whitelist can be used,
      to bind the triggering of the deletion to one or more IPs.


### Installation
All actions are from shops' root.
1) Copy file to
        
        source/modules/ith_modules/ith_clear_tmp
    
2) Add the module to shop repository

        composer config repositories.ith_modules.clear-template path source/modules/ith_modules/ith_clear_tmp
        
3) Install the module

        composer require ith_modules/clear-template --no-scripts --update-no-dev
        
4) Install module's configuration

        vendor/bin/oe-console oe:module:install-configuration path source/modules/ith_modules/ith_clear_tmp
        
5) Activate the module

        vendor/bin/oe-console oe:module:activate ith_clear_tmp

Or use the `*.sh` files provided in the `bin/` folder.

### Settings & Use
- Module settings:
    * Use hotkey to delete inPage
        + Activates the cache deletion from the store page
    * IP exceptions for hotkey use
        + By entering IPs, you can limit hotkey usage to these IPs.
    * Use PHP instead of Linux commands
       + It uses *glob* and *unlink* instead
- Main menu:
    * Verbose
        + If activated, the files that were deleted are listed.
- TMP DELETE in the header line:
    * A click clears the cache and reloads the page.
- inPage deletion:
    * Within the store page press CTRL + SHIFT + DEL (MAC) or CTRL + SHIFT + ALT + DEL (Windows/Linux).
        + If allowed, the cache will be cleared and the page will be reloaded.