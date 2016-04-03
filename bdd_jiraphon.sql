--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.1
-- Dumped by pg_dump version 9.5.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: equipe; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE equipe (
    id_equipe integer NOT NULL,
    spec text
);


ALTER TABLE equipe OWNER TO postgres;

--
-- Name: COLUMN equipe.spec; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN equipe.spec IS 'spécialité';


--
-- Name: Equipe_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Equipe_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Equipe_id_seq" OWNER TO postgres;

--
-- Name: Equipe_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Equipe_id_seq" OWNED BY equipe.id_equipe;


--
-- Name: projet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE projet (
    id_projet integer NOT NULL,
    date_deb date NOT NULL,
    date_fin date NOT NULL,
    description text NOT NULL,
    id_chef integer
);


ALTER TABLE projet OWNER TO postgres;

--
-- Name: Projet_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Projet_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Projet_id_seq" OWNER TO postgres;

--
-- Name: Projet_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Projet_id_seq" OWNED BY projet.id_projet;


--
-- Name: sprint; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE sprint (
    id_sprint integer NOT NULL,
    date_deb date NOT NULL,
    date_fin date NOT NULL,
    id_projet integer NOT NULL
);


ALTER TABLE sprint OWNER TO postgres;

--
-- Name: Sprint_id_sprint_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Sprint_id_sprint_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Sprint_id_sprint_seq" OWNER TO postgres;

--
-- Name: Sprint_id_sprint_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Sprint_id_sprint_seq" OWNED BY sprint.id_sprint;


--
-- Name: tache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tache (
    id_tache integer NOT NULL,
    nom text NOT NULL,
    "desc" text NOT NULL,
    etat character varying(9) NOT NULL,
    date_deb date,
    date_fin date,
    validation boolean NOT NULL,
    id_createur integer NOT NULL
);


ALTER TABLE tache OWNER TO postgres;

--
-- Name: COLUMN tache."desc"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tache."desc" IS 'description';


--
-- Name: COLUMN tache.date_deb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tache.date_deb IS 'date début de tache';


--
-- Name: COLUMN tache.validation; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tache.validation IS '0: tache non validée par chef 1: tache validée';


--
-- Name: Tache_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Tache_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Tache_id_seq" OWNER TO postgres;

--
-- Name: Tache_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Tache_id_seq" OWNED BY tache.id_tache;


SET default_with_oids = true;

--
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE utilisateur (
    id_utilisateur integer NOT NULL,
    nom text NOT NULL,
    prenom text NOT NULL,
    fonction text NOT NULL,
    statut boolean NOT NULL,
    photo oid,
    mdp character(64) NOT NULL
);


ALTER TABLE utilisateur OWNER TO postgres;

--
-- Name: TABLE utilisateur; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE utilisateur IS 'Base représentant utilisateurs / chef de projet (suivant état du statut)';


--
-- Name: COLUMN utilisateur.id_utilisateur; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN utilisateur.id_utilisateur IS 'identifiant ';


--
-- Name: COLUMN utilisateur.statut; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN utilisateur.statut IS '0 :utilisateur, 1: chef de projet';


--
-- Name: COLUMN utilisateur.photo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN utilisateur.photo IS 'photo non obligatoire';


--
-- Name: COLUMN utilisateur.mdp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN utilisateur.mdp IS 'encodage sha256';


--
-- Name: Utilisateur _id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Utilisateur _id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Utilisateur _id_seq" OWNER TO postgres;

--
-- Name: Utilisateur _id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Utilisateur _id_seq" OWNED BY utilisateur.id_utilisateur;


SET default_with_oids = false;

--
-- Name: equipe_in_projet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE equipe_in_projet (
    id_equipe integer NOT NULL,
    id_projet integer NOT NULL
);


ALTER TABLE equipe_in_projet OWNER TO postgres;

--
-- Name: TABLE equipe_in_projet; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE equipe_in_projet IS 'Association 0..n projets peuvent être associés avec 1..n equipes';


--
-- Name: membre_equipe; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE membre_equipe (
    id_utilisateur integer NOT NULL,
    id_equipe integer NOT NULL
);


ALTER TABLE membre_equipe OWNER TO postgres;

--
-- Name: TABLE membre_equipe; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE membre_equipe IS 'Association entre 1..n utilisateurs qui appartiennent à 0..n équipes';


--
-- Name: tache_in_sprint; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tache_in_sprint (
    id_sprint integer NOT NULL,
    id_tache integer NOT NULL
);


ALTER TABLE tache_in_sprint OWNER TO postgres;

--
-- Name: TABLE tache_in_sprint; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE tache_in_sprint IS 'Association 0..n sprints contiennent 1..n taches';


--
-- Name: utilisateur_in_projet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE utilisateur_in_projet (
    id_utilisateur integer NOT NULL,
    id_projet integer NOT NULL
);


ALTER TABLE utilisateur_in_projet OWNER TO postgres;

--
-- Name: id_equipe; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipe ALTER COLUMN id_equipe SET DEFAULT nextval('"Equipe_id_seq"'::regclass);


--
-- Name: id_projet; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY projet ALTER COLUMN id_projet SET DEFAULT nextval('"Projet_id_seq"'::regclass);


--
-- Name: id_sprint; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sprint ALTER COLUMN id_sprint SET DEFAULT nextval('"Sprint_id_sprint_seq"'::regclass);


--
-- Name: id_tache; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tache ALTER COLUMN id_tache SET DEFAULT nextval('"Tache_id_seq"'::regclass);


--
-- Name: id_utilisateur; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY utilisateur ALTER COLUMN id_utilisateur SET DEFAULT nextval('"Utilisateur _id_seq"'::regclass);


--
-- Name: Equipe_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Equipe_id_seq"', 1, true);


--
-- Name: Projet_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Projet_id_seq"', 1, true);


--
-- Name: Sprint_id_sprint_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Sprint_id_sprint_seq"', 2, true);


--
-- Name: Tache_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Tache_id_seq"', 2, true);


--
-- Name: Utilisateur _id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Utilisateur _id_seq"', 5, true);


--
-- Data for Name: equipe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY equipe (id_equipe, spec) FROM stdin;
\.


--
-- Data for Name: equipe_in_projet; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY equipe_in_projet (id_equipe, id_projet) FROM stdin;
\.


--
-- Data for Name: membre_equipe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY membre_equipe (id_utilisateur, id_equipe) FROM stdin;
\.


--
-- Data for Name: projet; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY projet (id_projet, date_deb, date_fin, description, id_chef) FROM stdin;
\.


--
-- Data for Name: sprint; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sprint (id_sprint, date_deb, date_fin, id_projet) FROM stdin;
\.


--
-- Data for Name: tache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tache (id_tache, nom, "desc", etat, date_deb, date_fin, validation, id_createur) FROM stdin;
\.


--
-- Data for Name: tache_in_sprint; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tache_in_sprint (id_sprint, id_tache) FROM stdin;
\.


--
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY utilisateur (id_utilisateur, nom, prenom, fonction, statut, photo, mdp) FROM stdin;
\.


--
-- Data for Name: utilisateur_in_projet; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY utilisateur_in_projet (id_utilisateur, id_projet) FROM stdin;
\.


--
-- Name: Equipe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipe
    ADD CONSTRAINT "Equipe_pkey" PRIMARY KEY (id_equipe);


--
-- Name: Projet_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY projet
    ADD CONSTRAINT "Projet_pkey" PRIMARY KEY (id_projet);


--
-- Name: Sprint_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sprint
    ADD CONSTRAINT "Sprint_pkey" PRIMARY KEY (id_sprint);


--
-- Name: Tache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tache
    ADD CONSTRAINT "Tache_pkey" PRIMARY KEY (id_tache);


--
-- Name: Utilisateur _pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY utilisateur
    ADD CONSTRAINT "Utilisateur _pkey" PRIMARY KEY (id_utilisateur);


--
-- Name: equipe_in_projet_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipe_in_projet
    ADD CONSTRAINT equipe_in_projet_pkey PRIMARY KEY (id_equipe, id_projet);


--
-- Name: membre_equipe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY membre_equipe
    ADD CONSTRAINT membre_equipe_pkey PRIMARY KEY (id_utilisateur, id_equipe);


--
-- Name: tache_in_sprint_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tache_in_sprint
    ADD CONSTRAINT tache_in_sprint_pkey PRIMARY KEY (id_sprint, id_tache);


--
-- Name: utilisateur_in_projet_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY utilisateur_in_projet
    ADD CONSTRAINT utilisateur_in_projet_pkey PRIMARY KEY (id_utilisateur, id_projet);


--
-- Name: equipe_in_projet_id_equipe_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipe_in_projet
    ADD CONSTRAINT equipe_in_projet_id_equipe_fkey FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: equipe_in_projet_id_projet_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY equipe_in_projet
    ADD CONSTRAINT equipe_in_projet_id_projet_fkey FOREIGN KEY (id_projet) REFERENCES projet(id_projet) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: foreign_createur; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tache
    ADD CONSTRAINT foreign_createur FOREIGN KEY (id_createur) REFERENCES utilisateur(id_utilisateur);


--
-- Name: membre_equipe_id_equipe_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY membre_equipe
    ADD CONSTRAINT membre_equipe_id_equipe_fkey FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: membre_equipe_id_utilisateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY membre_equipe
    ADD CONSTRAINT membre_equipe_id_utilisateur_fkey FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: projet_id_chef_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY projet
    ADD CONSTRAINT projet_id_chef_fkey FOREIGN KEY (id_chef) REFERENCES utilisateur(id_utilisateur) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: sprint_id_projet_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sprint
    ADD CONSTRAINT sprint_id_projet_fkey FOREIGN KEY (id_projet) REFERENCES projet(id_projet) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: tache_in_sprint_id_sprint_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tache_in_sprint
    ADD CONSTRAINT tache_in_sprint_id_sprint_fkey FOREIGN KEY (id_sprint) REFERENCES sprint(id_sprint) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: tache_in_sprint_id_tache_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tache_in_sprint
    ADD CONSTRAINT tache_in_sprint_id_tache_fkey FOREIGN KEY (id_tache) REFERENCES tache(id_tache) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: utilisateur_in_projet_id_projet_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY utilisateur_in_projet
    ADD CONSTRAINT utilisateur_in_projet_id_projet_fkey FOREIGN KEY (id_projet) REFERENCES projet(id_projet) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: utilisateur_in_projet_id_utilisateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY utilisateur_in_projet
    ADD CONSTRAINT utilisateur_in_projet_id_utilisateur_fkey FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

