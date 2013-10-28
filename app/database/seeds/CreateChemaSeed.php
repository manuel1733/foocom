<?php

class CreateChemaSeed extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::update("UPDATE employees SET mail = 'manuel@ilch.de', password = '" . hash('sha512', '5252e71433eaf') . "' WHERE id = 1");
        // DB::insert("INSERT INTO employees (mail, password, role_id) VALUES ('manuel@ilch.de', '2fd9f45405487fbcec1cba682cc9639968612c66e7c73d1cb1bcfc687c58e8d0dac0cb18eb16264f5757a5325d40eaf1a71abb42341321973a76c1b1a84c9554', 1)");

        DB::insert("INSERT INTO allergens (name) VALUES ('Glutenhaltiges Getreide')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Krebstiere')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Eier')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Fische')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Erdn\xc3\xbcsse')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Sojabohnen')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Milch')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Hartschalenobst (N\xc3\xbcsse)')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Sellerie')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Senf')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Sesamsamen')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Schwefeldioxid und Sulfite')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Lupinen')");
        DB::insert("INSERT INTO allergens (name) VALUES ('Weichtiere')");

        DB::insert("INSERT INTO countries (name) VALUES ('Switzerland')");
        DB::insert("INSERT INTO countries (name) VALUES ('Austria')");
        DB::insert("INSERT INTO countries (name) VALUES ('Germany')");

        DB::insert("INSERT INTO customer_groups (name, discount) VALUES ('Kunden', 0)");
        DB::insert("INSERT INTO customer_groups (name, discount) VALUES ('Genossenschaftler', 10)");
        DB::insert("INSERT INTO customer_groups (name, discount) VALUES ('Freunde', 20)");

        DB::insert("INSERT INTO labels (name) VALUES ('Bio')");
        DB::insert("INSERT INTO labels (name) VALUES ('Fairtrade')");

        DB::insert("INSERT INTO producers (name) VALUES ('Agrisan')");
        DB::insert("INSERT INTO producers (name) VALUES ('Alsan')");
        DB::insert("INSERT INTO producers (name) VALUES ('Booja-Booja')");
        DB::insert("INSERT INTO producers (name) VALUES ('Claro')");
        DB::insert("INSERT INTO producers (name) VALUES ('Demeter')");
        DB::insert("INSERT INTO producers (name) VALUES ('Lord of Tofu')");
        DB::insert("INSERT INTO producers (name) VALUES ('Provamel')");
        DB::insert("INSERT INTO producers (name) VALUES ('Vantastic Foods')");
        DB::insert("INSERT INTO producers (name) VALUES ('Vegi-Service')");
        DB::insert("INSERT INTO producers (name) VALUES ('Wilmersburger')");

        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (0, 'Trockensortiment')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (0, 'Non-Food-Sortiment')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (0, 'Projekte')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (0, 'Gutscheine')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (0, 'Frischsortiment')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (0, 'Genossenschaft')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (0, 'Sonderangebote')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Rahm-Alternativen')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Soja-Spezialitäten')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Streichkäse-Alternativen')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Margarine und Fette')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Milch-Alternativen')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Aufschnitt')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Burger')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Würste')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Frischteigwaren')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Fruchtsäfte')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Seitan-Spezialitäten')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Hartkäse-Alternativen')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Senf und Mayonnaise')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (1, 'Dessert und Pudding')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Bouillon')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Tomatenprodukte')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Ei-Alternativen')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Jerky')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Getreide')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Brotaufstriche salzig')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Trockenfrüchte')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Öl')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Zum Backen')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Güetzi')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Salzige Snacks')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Süssigkeiten')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Brotaufstriche süss')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Fertigsaucen')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Schokolade')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Süssungsmittel')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Vitamine & Nahrungsergänzung')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Halbfertiggerichte')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Müesli')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Backwaren')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Teigwaren')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Burgermischungen')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Würzmittel')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Frühstücksgetränke')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Nussmuse / Tahin')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Binde- und Geliermittel')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Salz')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Yogi-Tees')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (2, 'Hülsenfrüchte')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (3, 'Zahnpflege')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (3, 'Körperpflege')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (3, 'Reinigungsmittel')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (3, 'Waschmittel')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (3, 'Haarpflege')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (3, 'T-Shirts')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (3, 'Verhütungsmittel')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (3, 'Bücher')");
        DB::insert("INSERT INTO product_groups (parent_id, name) VALUES (3, 'Tierfutter')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
