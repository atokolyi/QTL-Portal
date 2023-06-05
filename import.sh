code_id=$1
nice_id=$2
phen_stats_file=$3
#phen_stats_delim=$4
sum_stats_file=$4
#sum_stats_delim=$6

# Could do a zcat/awk symlink to homogenise
# Flag for if sQTL (ranges) or eQTL (genes)

mysql -u root -ptest <<END_INPUT

use interval;

CREATE TABLE \`${code_id}_phenstats\` (
  \`phenotype_id\` varchar(50) NOT NULL,
  \`variant_rsid\` varchar(30) NOT NULL,
  \`tss_distance\` int(11) NOT NULL,
  \`ma_samples\` int(11) NOT NULL,
  \`ma_count\` int(11) NOT NULL,
  \`af\` float NOT NULL,
  \`slope\` float NOT NULL,
  \`slope_se\` float NOT NULL,
  \`qval_all\` double NOT NULL,
  \`gene_name\` varchar(200) NOT NULL,
  \`gene_range\` varchar(200) NOT NULL,
  \`gene_strand\` varchar(1) NOT NULL,
  \`gene_type\` varchar(200) NOT NULL,
  \`z_score\` float NOT NULL,
  \`z_score_abs\` float NOT NULL,
  PRIMARY KEY (\`phenotype_id\`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOAD DATA LOCAL INFILE '/home/${phen_stats_file}' INTO TABLE ${code_id}_phenstats FIELDS TERMINATED BY '\t' LINES TERMINATED BY '\n' IGNORE 1 LINES;

CREATE TABLE \`${code_id}_sumstats\` (
  \`phenotype_id\` varchar(50) NOT NULL,
  \`variant_rsid\` varchar(30) NOT NULL,
  \`tss_distance\` int(11) NOT NULL,
  \`af\` float NOT NULL,
  \`ma_samples\` int(11) NOT NULL,
  \`ma_count\` int(11) NOT NULL,
  \`pval_nominal\` double NOT NULL,
  \`slope\` float NOT NULL,
  \`slope_se\` float NOT NULL,
  \`variant_chr\` int(11) NOT NULL,
  \`variant_pos\` int(11) NOT NULL,
  \`variant_ref\` varchar(10) NOT NULL,
  \`variant_alt\` varchar(10) NOT NULL,
  \`variant_posid\` varchar(50) NOT NULL,
  \`id\` int(11) NOT NULL AUTO_INCREMENT,
  \`slope_inv\` float GENERATED ALWAYS AS (-1 * \`slope\`) VIRTUAL,
  \`z_score_abs\` float GENERATED ALWAYS AS (abs(\`slope\` / \`slope_se\`)) VIRTUAL,
  PRIMARY KEY (\`id\`),
  KEY \`phenotype_id\` (\`phenotype_id\`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

LOAD DATA LOCAL INFILE '/home/${sum_stats_file}' INTO TABLE ${code_id}_sumstats FIELDS TERMINATED BY '\t' LINES TERMINATED BY '\n' IGNORE 1 LINES (\`phenotype_id\`,\`variant_rsid\`,\`tss_distance\`,\`af\`,\`ma_samples\`,\`ma_count\`,\`pval_nominal\`,\`slope\`,\`slope_se\`,\`variant_chr\`,\`variant_pos\`,\`variant_ref\`,\`variant_alt\`,\`variant_posid\`);

INSERT INTO \`projects\` (\`code_name\`, \`nice_name\`) VALUES ('${code_id}', '${nice_id}'); 

END_INPUT
