#!/bin/bash

# Prompt for block name
read -p "Enter block name: " block_name

# Convert to lowercase and replace spaces with underscores
block_slug=$(echo "$block_name" | tr '[:upper:]' '[:lower:]' | tr ' ' '_')

# Define file paths
php_file="./page-templates/blocks/${block_slug}.php"
scss_file="./src/sass/theme/blocks/_${block_slug}.scss"
blocks_scss="./src/sass/theme/blocks/_blocks.scss"
blocks_php="./inc/cb-blocks.php"

# Create PHP and SCSS files
touch "$php_file"
touch "$scss_file"

echo "Created: $php_file"
echo "Created: $scss_file"

# Add import statement to _blocks.scss if not already present
if ! grep -q "@import '$block_slug';" "$blocks_scss"; then
    echo "@import '$block_slug';" >> "$blocks_scss"
    echo "Added @import to $blocks_scss"
else
    echo "Import already exists in $blocks_scss"
fi

# Define the block registration code
block_code="\n        acf_register_block_type(array(\n            'name'                => '$block_slug', \n            'title'               => __('$block_name'), \n            'category'            => 'layout',\n            'icon'                => 'cover-image', \n            'render_template'    => 'page-templates/blocks/$block_slug.php', \n            'mode'                => 'edit',\n            'supports'            => array('mode' => false),\n        ));\n"

# Insert block registration code into cb-blocks.php
if grep -q "function acf_blocks()" "$blocks_php"; then
    sed -i "/if (function_exists('acf_register_block_type')) {/a\\$block_code" "$blocks_php"
    echo "Added block registration to $blocks_php"
else
    echo "acf_blocks() function not found in $blocks_php. Please check the file."
fi
