# QTL-Portal: View & explore summary statistics in your browser

<!-- GETTING STARTED -->
## Getting Started

### Prerequisites

- [Docker](https://docs.docker.com/engine/install/)

### Installation

1. Clone this repo
   ```sh
   git clone https://github.com/atokolyi/qtl_portal.git
   ```
2. Start the QTL portal
   ```sh
   cd qtl_portal
   docker-compose up -d
   ```
3. Open the QTL portal in your web browser by visiting [http://localhost:8080](http://localhost:8080)


<!-- USAGE EXAMPLES -->
## Usage

### Example using GTEX summary statistics
1. Download phenotype-level and nominal summary statistics
```sh
cd data
wget https://storage.googleapis.com/gtex_analysis_v8/single_tissue_qtl_data/GTEx_Analysis_v8_eQTL.tar
untar GTEx_Analysis_v8_eQTL.tar
```
2. Import summary statistics using the `import-gtex` helper script
- Import is of the format: 
```id_name phenotype-summary-statistics.tsv nominal-summary-statistics.tsv```
```sh
   docker exec -it qtl_portal-mysql-server-1 import-gtex GTEX-Lung-eQTLs \
      data/GTEx_Analysis_v8_eQTL/Lung.v8.egenes.txt.gz \
      data/GTEx_Analysis_v8_eQTL/Lung.v8.signif_variant_gene_pairs.txt.gz
```
2. View the imported summary statistics

Refresh the QTL Portal ([http://localhost:8080](http://localhost:8080)) and click `GTEX-Lung-eQTLs` in the toolbar.


### Formatting other summary statistics
1. Import summary statistics
- Copy summary statistics to `data/`
- Import is of the format: 
```id_name display_name phenotype-summary-statistics.tsv nominal-summary-statistics.tsv```
   ```sh
   docker exec -it qtl_portal-mysql-server-1 import eqtl eQTL data/phenotype-summary-statistics.tsv data/nominal-summary-statistics.tsv
   ```
- `phenotype-summary-statistics.tsv` is a tab-separated file with column names:
- `nominal-summary-statistics.tsv` is a tab-separated file with column names:
2. View the imported summary statistics

Refresh the QTL Portal ([http://localhost:8080](http://localhost:8080)) and click the name in the toolbar 

3. Delete imported summary statistics
- Summary statistics imported in to the database persist through reboots unless deleted with:
  ```sh
  docker exec -it qtl_portal-mysql-server-1 delete eqtl
  ```

<!-- LICENSE -->
## License

Distributed under the GPLv3 License. See `LICENSE.txt` for more information.

