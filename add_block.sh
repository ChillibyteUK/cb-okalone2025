#!/bin/bash

# Prompt for block name
read -p "Enter block name: " block_name

# Convert to lowercase and replace spaces with underscores (for file naming)
block_slug=$(echo "$block_name" | tr '[:upper:]' '[:lower:]' | tr ' ' '_')

# Convert block name to kebab-case (for ACF location)
block_kebab=$(echo "$block_name" | tr '[:upper:]' '[:lower:]' | tr ' ' '-')

# Define file paths
php_file="./page-templates/blocks/${block_slug}.php"
scss_file="./src/sass/theme/blocks/_${block_slug}.scss"
blocks_scss="./src/sass/theme/blocks/_blocks.scss"
blocks_php="./inc/cb-blocks.php"
acf_json_file="./acf-json/group_${block_slug}.json"

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

# Create the block registration code in a temporary file
block_temp=$(mktemp)

cat > "$block_temp" <<EOF

        acf_register_block_type(array(
            'name'              => '$block_slug',
            'title'             => __('$block_name'),
            'category'          => 'layout',
            'icon'              => 'cover-image',
            'render_template'   => 'page-templates/blocks/$block_slug.php',
            'mode'              => 'edit',
            'supports'          => array('mode' => false),
        ));
EOF

# Insert block registration into cb-blocks.php
if grep -Fq "if (function_exists('acf_register_block_type')) {" "$blocks_php"; then

    if grep -Fq "'name'              => '$block_slug'" "$blocks_php"; then
        echo "Block registration already exists in $blocks_php"
    else
        awk -v insert_file="$block_temp" '
            {
                print
                if (!inserted && $0 ~ /if \(function_exists\('\''acf_register_block_type'\''\)\) \{/) {
                    while ((getline line < insert_file) > 0) {
                        print line
                    }
                    close(insert_file)
                    inserted = 1
                }
            }
        ' "$blocks_php" > "${blocks_php}.tmp"

        mv "${blocks_php}.tmp" "$blocks_php"

        echo "Added block registration to $blocks_php"
    fi

else
    echo "Could not find the ACF block registration section in $blocks_php"
fi

rm -f "$block_temp"

# Create ACF JSON skeleton with escaped forward slash and kebab-case block name
acf_json_content="{
    \"key\": \"group_${block_slug}\",
    \"title\": \"$block_name\",
    \"fields\": [
        {
            \"key\": \"field_${block_slug}_title\",
            \"label\": \"$block_name\",
            \"name\": \"title\",
            \"type\": \"message\"
        }
    ],
    \"location\": [
        [
            {
                \"param\": \"block\",
                \"operator\": \"==\",
                \"value\": \"acf\\/$block_kebab\"
            }
        ]
    ],
    \"active\": 1,
    \"description\": \"\"
}"

echo "$acf_json_content" > "$acf_json_file"
echo "Created ACF field group JSON: $acf_json_file"
