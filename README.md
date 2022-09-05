# ITholics - Module: Delete temporary files

**ModuleID:** *ith_clear_tmp* 

## Requirements
- OXID EE/PE/CE ^6.2
- PHP ^7.1

## Installation

    composer require itholics/oxid-clear-cache    

And also look at the `bin/*.sh` files.


###Features
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