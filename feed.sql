INSERT INTO `book` (`name`, `summary`) VALUES
    ('Les Aventures de Tom', 'Un jeune garçon découvre un monde magique caché dans sa ville.'),
    ('L\'Île Mystérieuse', 'Un groupe d’amis se retrouve coincé sur une île remplie de secrets.'),
    ('Le Secret du Pharaon', 'Un archéologue part à la recherche d’un trésor égyptien perdu.'),
    ('La Malédiction du Dragon', 'Une jeune fille découvre qu’elle est la descendante d’un ancien clan de dragons.'),
    ('L\'Ombre du Passé', 'Un détective enquête sur une série de crimes liés à une vieille légende urbaine.'),
    ('Éclipse Mortelle', 'Un thriller haletant où une astronome découvre un complot mondial.'),
    ('Le Royaume des Songes', 'Un adolescent se retrouve piégé dans un monde où ses rêves prennent vie.'),
    ('L\'Héritage des Anciens', 'Une quête épique à travers des ruines mystérieuses remplies d’énigmes.'),
    ('Cyber Révolution', 'Dans un futur proche, un groupe de hackers lutte contre un gouvernement oppressif.'),
    ('La Dernière Prophétie', 'Un prêtre découvre une prophétie qui pourrait changer le destin du monde.'),
    ('Les Chroniques du Temps', 'Un scientifique voyage accidentellement dans le passé et modifie l’histoire.'),
    ('Le Chant des Étoiles', 'Une musicienne découvre que ses mélodies peuvent influencer l’univers.'),
    ('L\'Enfant des Ombres', 'Un garçon né avec des pouvoirs mystérieux doit échapper à une organisation secrète.'),
    ('Terre Interdite', 'Un explorateur se rend dans une jungle inconnue et découvre une civilisation perdue.'),
    ('Le Labyrinthe des Âmes', 'Un homme se réveille dans un labyrinthe où chaque porte mène à une vie différente.'),
    ('Le Code du Destin', 'Un mathématicien perce le secret d’une équation qui prédit l’avenir.'),
    ('Les Gardiens du Savoir', 'Une bibliothèque cachée détient des livres aux pouvoirs insoupçonnés.'),
    ('Sous la Montagne Noire', 'Une expédition souterraine réveille une force ancienne et redoutable.'),
    ('Les Portes du Multivers', 'Un adolescent découvre qu’il peut voyager entre différentes réalités.'),
    ('Le Dernier Héros', 'Dans un monde en ruine, un guerrier doit accomplir une mission impossible.');
INSERT INTO book_tag (book_id, tag_id) VALUES (1, 1), (1, 2), (2, 1), (2, 3), (3, 2), (4, 1), (4, 3), (5, 3), (6, 1), (6, 2), (6, 3), (7, 2), (8, 1), (8, 3), (9, 1), (9, 2), (10, 3), (11, 2), (11, 3), (12, 1), (13, 2), (13, 3), (14, 1), (14, 2), (15, 3), (16, 1), (17, 2), (18, 1), (18, 3), (19, 2), (20, 1), (20, 2), (20, 3);
INSERT INTO tag(name) VALUES ('Roman'), ('Science-Fiction'), ('Fantasy'), ('Manga');