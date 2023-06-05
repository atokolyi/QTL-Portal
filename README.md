# QTL Portal
## Docker container to view & explore summary statistics in your browser

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

1. Copy summary statistics to data/, then import summary statistics

Import is of the format: `id_name display_name phenotype-level-summary-statistics.tsv nominal-summary-statistics.tsv`
   ```sh
   docker exec -it qtl_portal-mysql-server-1 import eqtl eQTL data/eqtl/sig_eqtls_webtrim_v2.tsv.h1k data/eqtl/nominal_eqtls_sigphen_norow_nop1.tsv.h1k
   ```
2. View the imported summary statistics

Refresh the QTL Portal ([http://localhost:8080](http://localhost:8080)) and click the name in the toolbar 

3. Summary statistics imported in to the database persist through reboots. Delete imported summary statistics with:
  ```sh
  docker exec -it qtl_portal-mysql-server-1 delete eqtl
  ```


<!-- LICENSE -->
## License

Distributed under the GPLv3 License. See `LICENSE.txt` for more information.

