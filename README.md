# SimpleIPAM - Simple IP address management

Cut down version of the original in docker etc


## Using
* Codeigniter 3.1.5
* Bootstrap v3.3.7
* jQuery v3.2.1
* DataTables 1.10.7
  * https://www.datatables.net/
* csv-import
  * CSV Import is a Codeigniter spark which makes it easy to import a CSV file into an associative array.
  * https://github.com/bradstinson/csv-import


## Configuration
### Change Per Page
Edit $config['per_page'] in controllers/Networks.php and controllers/Hosts.php  
For example, change  "5" to "300"  

## ChangeLog
vTZ
 * pick up fork revert README.md

v2.0
  * Delete Model Column in hosts

v1.0
  * First Release

