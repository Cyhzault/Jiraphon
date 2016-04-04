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
-- Name: postgres; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE postgres IS 'default administrative connection database';


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
-- Name: Equipe; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Equipe" (
    id integer NOT NULL,
    spec text
);


ALTER TABLE "Equipe" OWNER TO postgres;

--
-- Name: COLUMN "Equipe".spec; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN "Equipe".spec IS 'spécialité';


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

ALTER SEQUENCE "Equipe_id_seq" OWNED BY "Equipe".id;


--
-- Name: Equipe_in_projet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Equipe_in_projet" (
    id integer NOT NULL,
    id_equipe bit(4) NOT NULL,
    id_projet bit(4) NOT NULL
);


ALTER TABLE "Equipe_in_projet" OWNER TO postgres;

--
-- Name: TABLE "Equipe_in_projet"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE "Equipe_in_projet" IS 'Association 0..n projets peuvent être associés avec 1..n equipes';


--
-- Name: Equipe_in_projet_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Equipe_in_projet_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Equipe_in_projet_id_seq" OWNER TO postgres;

--
-- Name: Equipe_in_projet_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Equipe_in_projet_id_seq" OWNED BY "Equipe_in_projet".id;


--
-- Name: Membre_equipe; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Membre_equipe" (
    id integer NOT NULL,
    id_equipe bit(4) NOT NULL,
    id_utilisateur bit(4) NOT NULL
);


ALTER TABLE "Membre_equipe" OWNER TO postgres;

--
-- Name: TABLE "Membre_equipe"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE "Membre_equipe" IS 'Association entre 1..n utilisateurs qui appartiennent à 0..n équipes';


--
-- Name: Membre_equipe_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Membre_equipe_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Membre_equipe_id_seq" OWNER TO postgres;

--
-- Name: Membre_equipe_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Membre_equipe_id_seq" OWNED BY "Membre_equipe".id;


--
-- Name: Projet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Projet" (
    id integer NOT NULL,
    date_deb date NOT NULL,
    date_fin date NOT NULL,
    description text NOT NULL
);


ALTER TABLE "Projet" OWNER TO postgres;

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

ALTER SEQUENCE "Projet_id_seq" OWNED BY "Projet".id;


--
-- Name: Tache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Tache" (
    id integer NOT NULL,
    nom text NOT NULL,
    "desc" text NOT NULL,
    etat character varying(9) NOT NULL,
    date_deb date,
    date_fin date,
    validation boolean NOT NULL
);


ALTER TABLE "Tache" OWNER TO postgres;

--
-- Name: COLUMN "Tache"."desc"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN "Tache"."desc" IS 'description';


--
-- Name: COLUMN "Tache".date_deb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN "Tache".date_deb IS 'date début de tache';


--
-- Name: COLUMN "Tache".validation; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN "Tache".validation IS '0: tache non validée par chef 1: tache validée';


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

ALTER SEQUENCE "Tache_id_seq" OWNED BY "Tache".id;


--
-- Name: Tache_in_sprint; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Tache_in_sprint" (
    id integer NOT NULL,
    id_sprint bit(4) NOT NULL,
    id_tache bit(4) NOT NULL
);


ALTER TABLE "Tache_in_sprint" OWNER TO postgres;

--
-- Name: TABLE "Tache_in_sprint"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE "Tache_in_sprint" IS 'Association 0..n sprints contiennent 1..n taches';


--
-- Name: Tache_in_sprint_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Tache_in_sprint_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Tache_in_sprint_id_seq" OWNER TO postgres;

--
-- Name: Tache_in_sprint_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Tache_in_sprint_id_seq" OWNED BY "Tache_in_sprint".id;


SET default_with_oids = true;

--
-- Name: Utilisateur ; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "Utilisateur " (
    id integer NOT NULL,
    nom text NOT NULL,
    prenom text NOT NULL,
    fonction text NOT NULL,
    statut boolean NOT NULL,
    photo oid,
    mdp character(64)[] NOT NULL
);


ALTER TABLE "Utilisateur " OWNER TO postgres;

--
-- Name: TABLE "Utilisateur "; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE "Utilisateur " IS 'Base représentant utilisateurs / chef de projet (suivant état du statut)';


--
-- Name: COLUMN "Utilisateur ".id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN "Utilisateur ".id IS 'identifiant ';


--
-- Name: COLUMN "Utilisateur ".statut; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN "Utilisateur ".statut IS '0 :utilisateur, 1: chef de projet';


--
-- Name: COLUMN "Utilisateur ".photo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN "Utilisateur ".photo IS 'photo non obligatoire';


--
-- Name: COLUMN "Utilisateur ".mdp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN "Utilisateur ".mdp IS 'encodage sha256';


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

ALTER SEQUENCE "Utilisateur _id_seq" OWNED BY "Utilisateur ".id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Equipe" ALTER COLUMN id SET DEFAULT nextval('"Equipe_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Equipe_in_projet" ALTER COLUMN id SET DEFAULT nextval('"Equipe_in_projet_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Membre_equipe" ALTER COLUMN id SET DEFAULT nextval('"Membre_equipe_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Projet" ALTER COLUMN id SET DEFAULT nextval('"Projet_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Tache" ALTER COLUMN id SET DEFAULT nextval('"Tache_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Tache_in_sprint" ALTER COLUMN id SET DEFAULT nextval('"Tache_in_sprint_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Utilisateur " ALTER COLUMN id SET DEFAULT nextval('"Utilisateur _id_seq"'::regclass);


--
-- Data for Name: Equipe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Equipe" (id, spec) FROM stdin;
\.


--
-- Name: Equipe_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Equipe_id_seq"', 1, false);


--
-- Data for Name: Equipe_in_projet; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Equipe_in_projet" (id, id_equipe, id_projet) FROM stdin;
\.


--
-- Name: Equipe_in_projet_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Equipe_in_projet_id_seq"', 1, false);


--
-- Data for Name: Membre_equipe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Membre_equipe" (id, id_equipe, id_utilisateur) FROM stdin;
\.


--
-- Name: Membre_equipe_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Membre_equipe_id_seq"', 1, false);


--
-- Data for Name: Projet; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Projet" (id, date_deb, date_fin, description) FROM stdin;
\.


--
-- Name: Projet_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Projet_id_seq"', 1, false);


--
-- Data for Name: Tache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Tache" (id, nom, "desc", etat, date_deb, date_fin, validation) FROM stdin;
\.


--
-- Name: Tache_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Tache_id_seq"', 1, false);


--
-- Data for Name: Tache_in_sprint; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Tache_in_sprint" (id, id_sprint, id_tache) FROM stdin;
\.


--
-- Name: Tache_in_sprint_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Tache_in_sprint_id_seq"', 1, false);


--
-- Data for Name: Utilisateur ; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Utilisateur " (id, nom, prenom, fonction, statut, photo, mdp) FROM stdin;
\.


--
-- Name: Utilisateur _id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Utilisateur _id_seq"', 1, false);


--
-- Name: Equipe_in_projet_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Equipe_in_projet"
    ADD CONSTRAINT "Equipe_in_projet_pkey" PRIMARY KEY (id);


--
-- Name: Equipe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Equipe"
    ADD CONSTRAINT "Equipe_pkey" PRIMARY KEY (id);


--
-- Name: Membre_equipe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Membre_equipe"
    ADD CONSTRAINT "Membre_equipe_pkey" PRIMARY KEY (id);


--
-- Name: Projet_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Projet"
    ADD CONSTRAINT "Projet_pkey" PRIMARY KEY (id);


--
-- Name: Tache_in_sprint_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Tache_in_sprint"
    ADD CONSTRAINT "Tache_in_sprint_pkey" PRIMARY KEY (id);


--
-- Name: Tache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Tache"
    ADD CONSTRAINT "Tache_pkey" PRIMARY KEY (id);


--
-- Name: Utilisateur _pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Utilisateur "
    ADD CONSTRAINT "Utilisateur _pkey" PRIMARY KEY (id);


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

