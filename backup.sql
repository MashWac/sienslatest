--
-- PostgreSQL database dump
--

-- Dumped from database version 14.6 (Ubuntu 14.6-1.pgdg20.04+1)
-- Dumped by pg_dump version 14.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: heroku_ext; Type: SCHEMA; Schema: -; Owner: u3mccd13p8g100
--

CREATE SCHEMA heroku_ext;


ALTER SCHEMA heroku_ext OWNER TO u3mccd13p8g100;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: country; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.country (
    id bigint NOT NULL,
    iso character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    nicename character varying(255) NOT NULL,
    iso3 character varying(255) NOT NULL,
    numcode integer NOT NULL,
    phonecode integer NOT NULL
);


ALTER TABLE public.country OWNER TO prbqnyfvyfsexb;

--
-- Name: country_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.country_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.country_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: country_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.country_id_seq OWNED BY public.country.id;


--
-- Name: delivery; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.delivery (
    delivery_id integer NOT NULL,
    town character varying(255) NOT NULL,
    address character varying(255) NOT NULL,
    order_id integer NOT NULL,
    delivery_status character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.delivery OWNER TO prbqnyfvyfsexb;

--
-- Name: delivery_delivery_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.delivery_delivery_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.delivery_delivery_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: delivery_delivery_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.delivery_delivery_id_seq OWNED BY public.delivery.delivery_id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO prbqnyfvyfsexb;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: fquery; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.fquery (
    query_id integer NOT NULL,
    user_id integer NOT NULL,
    question text NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.fquery OWNER TO prbqnyfvyfsexb;

--
-- Name: fquery_query_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.fquery_query_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fquery_query_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: fquery_query_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.fquery_query_id_seq OWNED BY public.fquery.query_id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO prbqnyfvyfsexb;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: orderdetails; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.orderdetails (
    orderdetails_id integer NOT NULL,
    order_id integer NOT NULL,
    product_id integer NOT NULL,
    product_price integer NOT NULL,
    order_quantity integer NOT NULL,
    order_subtotal character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.orderdetails OWNER TO prbqnyfvyfsexb;

--
-- Name: orderdetails_orderdetails_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.orderdetails_orderdetails_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.orderdetails_orderdetails_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: orderdetails_orderdetails_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.orderdetails_orderdetails_id_seq OWNED BY public.orderdetails.orderdetails_id;


--
-- Name: orders; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.orders (
    order_id integer NOT NULL,
    user_id integer NOT NULL,
    order_amount integer NOT NULL,
    payment_id integer NOT NULL,
    order_status character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.orders OWNER TO prbqnyfvyfsexb;

--
-- Name: orders_order_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.orders_order_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.orders_order_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: orders_order_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.orders_order_id_seq OWNED BY public.orders.order_id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO prbqnyfvyfsexb;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO prbqnyfvyfsexb;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: pesapal_payments; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.pesapal_payments (
    id bigint NOT NULL,
    first_name character varying(255),
    last_name character varying(255),
    phone_number bigint,
    email text,
    amount text NOT NULL,
    currency character varying(255) NOT NULL,
    reference character varying(255) NOT NULL,
    description text NOT NULL,
    status text,
    tracking_id text,
    payment_method character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.pesapal_payments OWNER TO prbqnyfvyfsexb;

--
-- Name: pesapal_payments_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.pesapal_payments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pesapal_payments_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: pesapal_payments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.pesapal_payments_id_seq OWNED BY public.pesapal_payments.id;


--
-- Name: tbl_categories; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.tbl_categories (
    category_id integer NOT NULL,
    category_name character varying(255) NOT NULL,
    popularity integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tbl_categories OWNER TO prbqnyfvyfsexb;

--
-- Name: tbl_categories_category_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.tbl_categories_category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_categories_category_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: tbl_categories_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.tbl_categories_category_id_seq OWNED BY public.tbl_categories.category_id;


--
-- Name: tbl_discounts; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.tbl_discounts (
    discount_id integer NOT NULL,
    discount_code text NOT NULL,
    discount_percentage integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tbl_discounts OWNER TO prbqnyfvyfsexb;

--
-- Name: tbl_discounts_discount_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.tbl_discounts_discount_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_discounts_discount_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: tbl_discounts_discount_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.tbl_discounts_discount_id_seq OWNED BY public.tbl_discounts.discount_id;


--
-- Name: tbl_products; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.tbl_products (
    product_id integer NOT NULL,
    product_name character varying(255) NOT NULL,
    product_description text NOT NULL,
    unit_price integer NOT NULL,
    category integer NOT NULL,
    stock_available integer NOT NULL,
    prodpriority integer NOT NULL,
    product_image character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tbl_products OWNER TO prbqnyfvyfsexb;

--
-- Name: tbl_products_product_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.tbl_products_product_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_products_product_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: tbl_products_product_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.tbl_products_product_id_seq OWNED BY public.tbl_products.product_id;


--
-- Name: tbl_queries; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.tbl_queries (
    query_id integer NOT NULL,
    user_id integer NOT NULL,
    question text NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.tbl_queries OWNER TO prbqnyfvyfsexb;

--
-- Name: tbl_queries_query_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.tbl_queries_query_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_queries_query_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: tbl_queries_query_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.tbl_queries_query_id_seq OWNED BY public.tbl_queries.query_id;


--
-- Name: tbl_roles; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.tbl_roles (
    role_id integer NOT NULL,
    role_name character varying(255) NOT NULL
);


ALTER TABLE public.tbl_roles OWNER TO prbqnyfvyfsexb;

--
-- Name: tbl_roles_role_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.tbl_roles_role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_roles_role_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: tbl_roles_role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.tbl_roles_role_id_seq OWNED BY public.tbl_roles.role_id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE TABLE public.users (
    user_id integer NOT NULL,
    firstname character varying(255) NOT NULL,
    surname character varying(255) NOT NULL,
    email character varying(255),
    country character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    telephone integer NOT NULL,
    role_as integer DEFAULT 2 NOT NULL,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    is_deleted integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.users OWNER TO prbqnyfvyfsexb;

--
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_user_id_seq OWNER TO prbqnyfvyfsexb;

--
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;


--
-- Name: country id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.country ALTER COLUMN id SET DEFAULT nextval('public.country_id_seq'::regclass);


--
-- Name: delivery delivery_id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.delivery ALTER COLUMN delivery_id SET DEFAULT nextval('public.delivery_delivery_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: fquery query_id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.fquery ALTER COLUMN query_id SET DEFAULT nextval('public.fquery_query_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: orderdetails orderdetails_id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.orderdetails ALTER COLUMN orderdetails_id SET DEFAULT nextval('public.orderdetails_orderdetails_id_seq'::regclass);


--
-- Name: orders order_id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.orders ALTER COLUMN order_id SET DEFAULT nextval('public.orders_order_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: pesapal_payments id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.pesapal_payments ALTER COLUMN id SET DEFAULT nextval('public.pesapal_payments_id_seq'::regclass);


--
-- Name: tbl_categories category_id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.tbl_categories ALTER COLUMN category_id SET DEFAULT nextval('public.tbl_categories_category_id_seq'::regclass);


--
-- Name: tbl_discounts discount_id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.tbl_discounts ALTER COLUMN discount_id SET DEFAULT nextval('public.tbl_discounts_discount_id_seq'::regclass);


--
-- Name: tbl_products product_id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.tbl_products ALTER COLUMN product_id SET DEFAULT nextval('public.tbl_products_product_id_seq'::regclass);


--
-- Name: tbl_queries query_id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.tbl_queries ALTER COLUMN query_id SET DEFAULT nextval('public.tbl_queries_query_id_seq'::regclass);


--
-- Name: tbl_roles role_id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.tbl_roles ALTER COLUMN role_id SET DEFAULT nextval('public.tbl_roles_role_id_seq'::regclass);


--
-- Name: users user_id; Type: DEFAULT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);


--
-- Data for Name: country; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.country (id, iso, name, nicename, iso3, numcode, phonecode) FROM stdin;
1	AF	AFGHANISTAN	Afghanistan	AFG	4	93
2	AL	ALBANIA	Albania	ALB	8	355
3	DZ	ALGERIA	Algeria	DZA	12	213
4	AS	AMERICAN SAMOA	American Samoa	ASM	16	1684
5	AD	ANDORRA	Andorra	AND	20	376
6	AO	ANGOLA	Angola	AGO	24	244
7	AI	ANGUILLA	Anguilla	AIA	660	1264
8	AQ	ANTARCTICA	Antarctica	ATA	10	0
9	AG	ANTIGUA AND BARBUDA	Antigua and Barbuda	ATG	28	1268
10	AR	ARGENTINA	Argentina	ARG	32	54
11	AM	ARMENIA	Armenia	ARM	51	374
12	AW	ARUBA	Aruba	ABW	533	297
13	AU	AUSTRALIA	Australia	AUS	36	61
14	AT	AUSTRIA	Austria	AUT	40	43
15	AZ	AZERBAIJAN	Azerbaijan	AZE	31	994
16	BS	BAHAMAS	Bahamas	BHS	44	1242
17	BH	BAHRAIN	Bahrain	BHR	48	973
18	BD	BANGLADESH	Bangladesh	BGD	50	880
19	BB	BARBADOS	Barbados	BRB	52	1246
20	BY	BELARUS	Belarus	BLR	112	375
21	BE	BELGIUM	Belgium	BEL	56	32
22	BZ	BELIZE	Belize	BLZ	84	501
23	BJ	BENIN	Benin	BEN	204	229
24	BM	BERMUDA	Bermuda	BMU	60	1441
25	BT	BHUTAN	Bhutan	BTN	64	975
26	BO	BOLIVIA	Bolivia	BOL	68	591
27	BA	BOSNIA AND HERZEGOVINA	Bosnia and Herzegovina	BIH	70	387
28	BW	BOTSWANA	Botswana	BWA	72	267
29	BV	BOUVET ISLAND	Bouvet Island	BVT	74	0
30	BR	BRAZIL	Brazil	BRA	76	55
31	IO	BRITISH INDIAN OCEAN TERRITORY	British Indian Ocean Territory	IOT	86	246
32	BN	BRUNEI DARUSSALAM	Brunei Darussalam	BRN	96	673
33	BG	BULGARIA	Bulgaria	BGR	100	359
34	BF	BURKINA FASO	Burkina Faso	BFA	854	226
35	BI	BURUNDI	Burundi	BDI	108	257
36	KH	CAMBODIA	Cambodia	KHM	116	855
37	CM	CAMEROON	Cameroon	CMR	120	237
38	CA	CANADA	Canada	CAN	124	1
39	CV	CAPE VERDE	Cape Verde	CPV	132	238
40	KY	CAYMAN ISLANDS	Cayman Islands	CYM	136	1345
41	CF	CENTRAL AFRICAN REPUBLIC	Central African Republic	CAF	140	236
42	TD	CHAD	Chad	TCD	148	235
43	CL	CHILE	Chile	CHL	152	56
44	CN	CHINA	China	CHN	156	86
45	CX	CHRISTMAS ISLAND	Christmas Island	CXR	162	61
47	CO	COLOMBIA	Colombia	COL	170	57
48	KM	COMOROS	Comoros	COM	174	269
49	CG	CONGO	Congo	COG	178	242
50	CD	CONGO, THE DEMOCRATIC REPUBLIC OF THE	Congo, the Democratic Republic of the	COD	180	242
51	CK	COOK ISLANDS	Cook Islands	COK	184	682
52	CR	COSTA RICA	Costa Rica	CRI	188	506
53	CI	COTE D'IVOIRE	Cote D'Ivoire	CIV	384	225
54	HR	CROATIA	Croatia	HRV	191	385
55	CU	CUBA	Cuba	CUB	192	53
56	CY	CYPRUS	Cyprus	CYP	196	357
57	CZ	CZECHIA	Czech Republic	CZE	203	420
58	DK	DENMARK	Denmark	DNK	208	45
59	DJ	DJIBOUTI	Djibouti	DJI	262	253
60	DM	DOMINICA	Dominica	DMA	212	1767
61	DO	DOMINICAN REPUBLIC	Dominican Republic	DOM	214	1
62	EC	ECUADOR	Ecuador	ECU	218	593
63	EG	EGYPT	Egypt	EGY	818	20
64	SV	EL SALVADOR	El Salvador	SLV	222	503
65	GQ	EQUATORIAL GUINEA	Equatorial Guinea	GNQ	226	240
66	ER	ERITREA	Eritrea	ERI	232	291
67	EE	ESTONIA	Estonia	EST	233	372
68	ET	ETHIOPIA	Ethiopia	ETH	231	251
69	FK	FALKLAND ISLANDS (MALVINAS)	Falkland Islands (Malvinas)	FLK	238	500
70	FO	FAROE ISLANDS	Faroe Islands	FRO	234	298
71	FJ	FIJI	Fiji	FJI	242	679
72	FI	FINLAND	Finland	FIN	246	358
73	FR	FRANCE	France	FRA	250	33
74	GF	FRENCH GUIANA	French Guiana	GUF	254	594
75	PF	FRENCH POLYNESIA	French Polynesia	PYF	258	689
76	TF	FRENCH SOUTHERN TERRITORIES	French Southern Territories	ATF	260	0
77	GA	GABON	Gabon	GAB	266	241
78	GM	GAMBIA	Gambia	GMB	270	220
79	GE	GEORGIA	Georgia	GEO	268	995
80	DE	GERMANY	Germany	DEU	276	49
81	GH	GHANA	Ghana	GHA	288	233
82	GI	GIBRALTAR	Gibraltar	GIB	292	350
83	GR	GREECE	Greece	GRC	300	30
84	GL	GREENLAND	Greenland	GRL	304	299
85	GD	GRENADA	Grenada	GRD	308	1473
86	GP	GUADELOUPE	Guadeloupe	GLP	312	590
87	GU	GUAM	Guam	GUM	316	1671
88	GT	GUATEMALA	Guatemala	GTM	320	502
89	GN	GUINEA	Guinea	GIN	324	224
90	GW	GUINEA-BISSAU	Guinea-Bissau	GNB	624	245
91	GY	GUYANA	Guyana	GUY	328	592
92	HT	HAITI	Haiti	HTI	332	509
93	HM	HEARD ISLAND AND MCDONALD ISLANDS	Heard Island and Mcdonald Islands	HMD	334	0
94	VA	HOLY SEE (VATICAN CITY STATE)	Holy See (Vatican City State)	VAT	336	39
95	HN	HONDURAS	Honduras	HND	340	504
96	HK	HONG KONG	Hong Kong	HKG	344	852
97	HU	HUNGARY	Hungary	HUN	348	36
98	IS	ICELAND	Iceland	ISL	352	354
99	IN	INDIA	India	IND	356	91
100	ID	INDONESIA	Indonesia	IDN	360	62
101	IR	IRAN, ISLAMIC REPUBLIC OF	Iran, Islamic Republic of	IRN	364	98
102	IQ	IRAQ	Iraq	IRQ	368	964
103	IE	IRELAND	Ireland	IRL	372	353
104	IL	ISRAEL	Israel	ISR	376	972
105	IT	ITALY	Italy	ITA	380	39
106	JM	JAMAICA	Jamaica	JAM	388	1876
107	JP	JAPAN	Japan	JPN	392	81
108	JO	JORDAN	Jordan	JOR	400	962
109	KZ	KAZAKHSTAN	Kazakhstan	KAZ	398	7
110	KE	KENYA	Kenya	KEN	404	254
111	KI	KIRIBATI	Kiribati	KIR	296	686
112	KP	KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF	Korea, Democratic People's Republic of	PRK	408	850
113	KR	KOREA, REPUBLIC OF	Korea, Republic of	KOR	410	82
114	KW	KUWAIT	Kuwait	KWT	414	965
115	KG	KYRGYZSTAN	Kyrgyzstan	KGZ	417	996
116	LA	LAO PEOPLE'S DEMOCRATIC REPUBLIC	Lao People's Democratic Republic	LAO	418	856
117	LV	LATVIA	Latvia	LVA	428	371
118	LB	LEBANON	Lebanon	LBN	422	961
119	LS	LESOTHO	Lesotho	LSO	426	266
120	LR	LIBERIA	Liberia	LBR	430	231
121	LY	LIBYAN ARAB JAMAHIRIYA	Libyan Arab Jamahiriya	LBY	434	218
122	LI	LIECHTENSTEIN	Liechtenstein	LIE	438	423
123	LT	LITHUANIA	Lithuania	LTU	440	370
124	LU	LUXEMBOURG	Luxembourg	LUX	442	352
125	MO	MACAO	Macao	MAC	446	853
126	MK	NORTH MACEDONIA	North Macedonia	MKD	807	389
127	MG	MADAGASCAR	Madagascar	MDG	450	261
128	MW	MALAWI	Malawi	MWI	454	265
129	MY	MALAYSIA	Malaysia	MYS	458	60
130	MV	MALDIVES	Maldives	MDV	462	960
131	ML	MALI	Mali	MLI	466	223
132	MT	MALTA	Malta	MLT	470	356
133	MH	MARSHALL ISLANDS	Marshall Islands	MHL	584	692
134	MQ	MARTINIQUE	Martinique	MTQ	474	596
135	MR	MAURITANIA	Mauritania	MRT	478	222
136	MU	MAURITIUS	Mauritius	MUS	480	230
137	YT	MAYOTTE	Mayotte	MYT	175	269
138	MX	MEXICO	Mexico	MEX	484	52
139	FM	MICRONESIA, FEDERATED STATES OF	Micronesia, Federated States of	FSM	583	691
140	MD	MOLDOVA, REPUBLIC OF	Moldova, Republic of	MDA	498	373
141	MC	MONACO	Monaco	MCO	492	377
142	MN	MONGOLIA	Mongolia	MNG	496	976
143	MS	MONTSERRAT	Montserrat	MSR	500	1664
144	MA	MOROCCO	Morocco	MAR	504	212
145	MZ	MOZAMBIQUE	Mozambique	MOZ	508	258
146	MM	MYANMAR	Myanmar	MMR	104	95
147	NA	NAMIBIA	Namibia	NAM	516	264
148	NR	NAURU	Nauru	NRU	520	674
149	NP	NEPAL	Nepal	NPL	524	977
150	NL	NETHERLANDS	Netherlands	NLD	528	31
151	AN	NETHERLANDS ANTILLES	Netherlands Antilles	ANT	530	599
152	NC	NEW CALEDONIA	New Caledonia	NCL	540	687
153	NZ	NEW ZEALAND	New Zealand	NZL	554	64
154	NI	NICARAGUA	Nicaragua	NIC	558	505
155	NE	NIGER	Niger	NER	562	227
156	NG	NIGERIA	Nigeria	NGA	566	234
157	NU	NIUE	Niue	NIU	570	683
158	NF	NORFOLK ISLAND	Norfolk Island	NFK	574	672
159	MP	NORTHERN MARIANA ISLANDS	Northern Mariana Islands	MNP	580	1670
160	NO	NORWAY	Norway	NOR	578	47
161	OM	OMAN	Oman	OMN	512	968
162	PK	PAKISTAN	Pakistan	PAK	586	92
163	PW	PALAU	Palau	PLW	585	680
165	PA	PANAMA	Panama	PAN	591	507
166	PG	PAPUA NEW GUINEA	Papua New Guinea	PNG	598	675
167	PY	PARAGUAY	Paraguay	PRY	600	595
168	PE	PERU	Peru	PER	604	51
169	PH	PHILIPPINES	Philippines	PHL	608	63
170	PN	PITCAIRN	Pitcairn	PCN	612	0
171	PL	POLAND	Poland	POL	616	48
172	PT	PORTUGAL	Portugal	PRT	620	351
173	PR	PUERTO RICO	Puerto Rico	PRI	630	1787
174	QA	QATAR	Qatar	QAT	634	974
175	RE	REUNION	Reunion	REU	638	262
176	RO	ROMANIA	Romania	ROU	642	40
177	RU	RUSSIAN FEDERATION	Russian Federation	RUS	643	7
178	RW	RWANDA	Rwanda	RWA	646	250
179	SH	SAINT HELENA	Saint Helena	SHN	654	290
180	KN	SAINT KITTS AND NEVIS	Saint Kitts and Nevis	KNA	659	1869
181	LC	SAINT LUCIA	Saint Lucia	LCA	662	1758
182	PM	SAINT PIERRE AND MIQUELON	Saint Pierre and Miquelon	SPM	666	508
183	VC	SAINT VINCENT AND THE GRENADINES	Saint Vincent and the Grenadines	VCT	670	1784
184	WS	SAMOA	Samoa	WSM	882	684
185	SM	SAN MARINO	San Marino	SMR	674	378
186	ST	SAO TOME AND PRINCIPE	Sao Tome and Principe	STP	678	239
187	SA	SAUDI ARABIA	Saudi Arabia	SAU	682	966
188	SN	SENEGAL	Senegal	SEN	686	221
189	RS	SERBIA	Serbia	SRB	688	381
190	SC	SEYCHELLES	Seychelles	SYC	690	248
191	SL	SIERRA LEONE	Sierra Leone	SLE	694	232
192	SG	SINGAPORE	Singapore	SGP	702	65
193	SK	SLOVAKIA	Slovakia	SVK	703	421
194	SI	SLOVENIA	Slovenia	SVN	705	386
195	SB	SOLOMON ISLANDS	Solomon Islands	SLB	90	677
196	SO	SOMALIA	Somalia	SOM	706	252
197	ZA	SOUTH AFRICA	South Africa	ZAF	710	27
198	GS	SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS	South Georgia and the South Sandwich Islands	SGS	239	0
199	ES	SPAIN	Spain	ESP	724	34
200	LK	SRI LANKA	Sri Lanka	LKA	144	94
201	SD	SUDAN	Sudan	SDN	736	249
202	SR	SURINAME	Suriname	SUR	740	597
203	SJ	SVALBARD AND JAN MAYEN	Svalbard and Jan Mayen	SJM	744	47
204	SZ	SWAZILAND	Swaziland	SWZ	748	268
205	SE	SWEDEN	Sweden	SWE	752	46
206	CH	SWITZERLAND	Switzerland	CHE	756	41
207	SY	SYRIAN ARAB REPUBLIC	Syrian Arab Republic	SYR	760	963
208	TW	TAIWAN, PROVINCE OF CHINA	Taiwan, Province of China	TWN	158	886
209	TJ	TAJIKISTAN	Tajikistan	TJK	762	992
210	TZ	TANZANIA, UNITED REPUBLIC OF	Tanzania, United Republic of	TZA	834	255
211	TH	THAILAND	Thailand	THA	764	66
212	TL	TIMOR-LESTE	Timor-Leste	TLS	626	670
213	TG	TOGO	Togo	TGO	768	228
214	TK	TOKELAU	Tokelau	TKL	772	690
215	TO	TONGA	Tonga	TON	776	676
216	TT	TRINIDAD AND TOBAGO	Trinidad and Tobago	TTO	780	1868
217	TN	TUNISIA	Tunisia	TUN	788	216
218	TR	TURKEY	Turkey	TUR	792	90
219	TM	TURKMENISTAN	Turkmenistan	TKM	795	993
220	TC	TURKS AND CAICOS ISLANDS	Turks and Caicos Islands	TCA	796	1649
221	TV	TUVALU	Tuvalu	TUV	798	688
222	UG	UGANDA	Uganda	UGA	800	256
223	UA	UKRAINE	Ukraine	UKR	804	380
224	AE	UNITED ARAB EMIRATES	United Arab Emirates	ARE	784	971
225	GB	UNITED KINGDOM	United Kingdom	GBR	826	44
226	US	UNITED STATES	United States	USA	840	1
227	UM	UNITED STATES MINOR OUTLYING ISLANDS	United States Minor Outlying Islands	UMI	581	1
228	UY	URUGUAY	Uruguay	URY	858	598
229	UZ	UZBEKISTAN	Uzbekistan	UZB	860	998
230	VU	VANUATU	Vanuatu	VUT	548	678
231	VE	VENEZUELA	Venezuela	VEN	862	58
232	VN	VIET NAM	Viet Nam	VNM	704	84
233	VG	VIRGIN ISLANDS, BRITISH	Virgin Islands, British	VGB	92	1284
234	VI	VIRGIN ISLANDS, U.S.	Virgin Islands, U.s.	VIR	850	1340
235	WF	WALLIS AND FUTUNA	Wallis and Futuna	WLF	876	681
236	EH	WESTERN SAHARA	Western Sahara	ESH	732	212
237	YE	YEMEN	Yemen	YEM	887	967
238	ZM	ZAMBIA	Zambia	ZMB	894	260
239	ZW	ZIMBABWE	Zimbabwe	ZWE	716	263
240	ME	MONTENEGRO	Montenegro	MNE	499	382
241	XK	KOSOVO	Kosovo	XKX	0	383
242	AX	ALAND ISLANDS	Aland Islands	ALA	248	358
243	BQ	BONAIRE, SINT EUSTATIUS AND SABA	Bonaire, Sint Eustatius and Saba	BES	535	599
244	CW	CURACAO	Curacao	CUW	531	599
245	GG	GUERNSEY	Guernsey	GGY	831	44
246	IM	ISLE OF MAN	Isle of Man	IMN	833	44
247	JE	JERSEY	Jersey	JEY	832	44
248	BL	SAINT BARTHELEMY	Saint Barthelemy	BLM	652	590
249	MF	SAINT MARTIN	Saint Martin	MAF	663	590
250	SX	SINT MAARTEN	Sint Maarten	SXM	534	1
251	SS	SOUTH SUDAN	South Sudan	SSD	728	211
\.


--
-- Data for Name: delivery; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.delivery (delivery_id, town, address, order_id, delivery_status, created_at, updated_at, is_deleted) FROM stdin;
1	Nairobi	marurui rd	1	DELIVERED	2022-09-06 09:25:33	2022-09-06 10:30:38	0
2	Kilifi	tyfckc	2	PENDING	2022-09-06 13:14:50	2022-09-06 13:14:50	0
3	Nairobi	gkch	3	PENDING	2022-09-06 18:59:02	2022-09-06 18:59:02	0
4	Nairobi	gkch	4	DELIVERED	2022-09-06 19:05:44	2022-09-06 19:28:44	0
5	Nairobi	gkch	5	PENDING	2022-12-08 09:54:56	2022-12-08 09:54:56	0
6	Nairobi	gkch	6	PENDING	2022-12-08 09:59:07	2022-12-08 09:59:07	0
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: fquery; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.fquery (query_id, user_id, question, created_at, updated_at, is_deleted) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_resets_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2020_15_06_000000_create_pesapal_payments_table	1
6	2022_08_15_211730_create_tblroles_table	1
7	2022_08_16_112221_create_tblproducts	1
8	2022_08_16_113016_create_country_table	1
9	2022_08_16_113355_create_tbl_categories_table	1
10	2022_08_19_165635_create_delivery_table	1
11	2022_08_19_165753_create_order_table	1
12	2022_08_19_165817_create_orderdetails_table	1
13	2022_08_22_130631_create_queries_table	1
14	2022_08_22_175532_create_fquery_table	1
15	2022_10_29_162429_tbl_discounts	2
\.


--
-- Data for Name: orderdetails; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.orderdetails (orderdetails_id, order_id, product_id, product_price, order_quantity, order_subtotal, created_at, updated_at, is_deleted) FROM stdin;
1	1	1	1	1	1	2022-09-06 09:25:33	2022-09-06 09:25:33	0
2	2	1	1	1	1	2022-09-06 13:14:50	2022-09-06 13:14:50	0
3	3	5	1	1	1	2022-09-06 18:59:02	2022-09-06 18:59:02	0
4	4	6	1	1	1	2022-09-06 19:05:44	2022-09-06 19:05:44	0
5	5	64	11	1	11	2022-12-08 09:54:56	2022-12-08 09:54:56	0
6	6	64	1100	1	1100	2022-12-08 09:59:07	2022-12-08 09:59:07	0
\.


--
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.orders (order_id, user_id, order_amount, payment_id, order_status, created_at, updated_at, is_deleted) FROM stdin;
1	1	1	1	DELIVERED	2022-09-06 09:25:33	2022-09-06 10:30:38	0
2	1	1	4	PROCESSING	2022-09-06 13:14:50	2022-09-06 13:14:50	0
3	1	1	5	PROCESSING	2022-09-06 18:59:02	2022-09-06 18:59:02	0
4	1	1	6	DELIVERED	2022-09-06 19:05:44	2022-09-06 19:28:44	0
5	1	11	9	PROCESSING	2022-12-08 09:54:56	2022-12-08 09:54:56	0
6	1	1100	10	PROCESSING	2022-12-08 09:59:07	2022-12-08 09:59:07	0
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: pesapal_payments; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.pesapal_payments (id, first_name, last_name, phone_number, email, amount, currency, reference, description, status, tracking_id, payment_method, created_at, updated_at) FROM stdin;
1	user	one	254757769602	user@email.com	1.00	KES	SIEA-631711bd7e95f	Product payments	COMPLETED	d1249c5a-0d07-4ea1-9d53-dfa4f2284227	MPESAKE	2022-09-06 09:24:15	2022-09-06 09:25:33
2	Kelvin	Wachira	254725009085	kelvingertler@gmail.com	1.00	KES	SIEA-63172d4a782b6	Product payments	\N	\N	\N	2022-09-06 11:21:54	2022-09-06 11:21:54
3	Kelvin	Wachira	254725009085	kelvingertler@gmail.com	1.00	KES	SIEA-63172dc100172	Product payments	\N	\N	\N	2022-09-06 11:23:47	2022-09-06 11:23:47
4	user	one	254757769602	user@email.com	1.00	KES	SIEA-6317478ca8623	Product payments	COMPLETED	446e86bf-ae5e-4d16-9c29-dfa4e64da727	MPESAKE	2022-09-06 13:13:51	2022-09-06 13:14:50
5	user	two	254757769602	user@email.com	1.00	KES	SIEA-6317980ac420c	Product payments	COMPLETED	cce426da-d6d5-4cae-8333-dfa4e3aef6c9	MPESAKE	2022-09-06 18:57:16	2022-09-06 18:59:02
6	user	two	254757769602	user@email.com	1.00	KES	SIEA-631799cee71a4	Product payments	COMPLETED	455e0e1a-27d0-4711-9a0c-dfa45751c2fd	MPESAKE	2022-09-06 19:04:50	2022-09-06 19:05:43
7	user	two	254757769602	user@email.com	3,510.00	KES	SIEA-635d5d1f23b56	Product payments	\N	\N	\N	2022-10-29 20:04:34	2022-10-29 20:04:34
8	margaret	macharia	254721412955	mmwachi@yahoo.com	1,200.00	KES	SIEA-6385cb32d6106	Product payments	\N	\N	\N	2022-11-29 12:04:55	2022-11-29 12:04:55
9	user	two	254757769602	user@email.com	11.00	KES	SIEA-6391898968672	Product payments	COMPLETED	dc5478c5-3f2b-4151-afee-df47e6cf924f	CREDITCARDMC_ACP_KE	2022-12-08 09:52:00	2022-12-08 09:54:56
10	user	two	254757769602	user@email.com	1,100.00	KES	SIEA-63918accb6b04	Product payments	COMPLETED	71eaf689-6b89-4bd5-b35d-df4767d4cb76	CREDITCARDMC_ACP_KE	2022-12-08 09:57:20	2022-12-08 09:59:07
\.


--
-- Data for Name: tbl_categories; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.tbl_categories (category_id, category_name, popularity, created_at, updated_at, is_deleted) FROM stdin;
3	BIOENERGETICS	0	2022-09-06 15:02:49	2022-09-06 19:26:18	1
12	HEALTH EQUIPMENTS	0	2022-10-20 23:12:48	2022-10-25 16:58:08	1
14	protein powder	0	2022-10-20 23:14:14	2022-10-25 17:43:02	0
15	joint care	0	2022-10-20 23:17:23	2022-10-25 17:43:39	0
17	women health	0	2022-10-25 17:08:29	2022-10-25 17:44:01	0
9	weight and cholesterol	0	2022-10-20 23:07:35	2022-10-25 17:44:27	0
7	health and fitness	0	2022-10-20 21:46:33	2022-10-25 17:44:39	0
18	sports and nutrition	0	2022-10-25 17:20:01	2022-10-25 17:45:12	0
20	colon detox	0	2022-10-25 17:45:27	2022-10-25 17:45:27	0
19	probiotics	0	2022-10-25 17:20:33	2022-10-25 17:45:45	0
5	vitamins and minerals	0	2022-09-08 19:58:21	2022-10-25 17:46:07	0
21	constipation and gases	0	2022-10-25 18:03:57	2022-10-25 18:03:57	0
11	brain and cognitive health	0	2022-10-20 23:12:12	2022-10-25 18:07:28	0
23	high blood pressure	0	2022-10-25 18:08:56	2022-10-25 18:08:56	0
24	diabetes	0	2022-10-25 18:09:07	2022-10-25 18:09:07	0
22	immunity and allergies	0	2022-10-25 18:04:23	2022-10-25 18:10:35	0
26	eye care	0	2022-10-29 13:31:07	2022-10-29 13:31:07	0
16	Household health devices	0	2022-10-25 16:55:25	2022-10-29 13:57:18	0
27	Healthy cookware	0	2022-10-31 12:40:39	2022-10-31 12:40:39	0
28	Beauty and personal care	0	2022-10-31 12:41:13	2022-10-31 12:41:13	0
29	digital catalogues	0	2022-10-31 12:43:00	2022-10-31 12:43:00	0
30	Beauty and Massage oils	0	2022-10-31 16:01:52	2022-10-31 16:01:52	0
31	probiotics	0	2022-10-31 17:41:27	2022-10-31 18:32:23	1
32	immune boosters	0	2022-10-31 18:29:09	2022-10-31 18:42:32	1
33	Detoxification	0	2022-11-01 14:15:22	2022-11-01 14:15:22	0
8	superfoods	0	2022-10-20 23:05:47	2022-11-01 14:37:27	1
34	Men Health	0	2022-11-01 14:46:27	2022-11-01 14:46:27	0
13	digestive health	0	2022-10-20 23:13:33	2022-11-02 16:13:42	1
37	Healthy Seeds	0	2022-11-03 14:53:34	2022-11-03 14:53:34	0
10	health and beauty	0	2022-10-20 23:11:30	2022-11-25 12:48:56	1
38	Eye care	0	2022-11-25 12:34:52	2022-11-25 12:53:08	1
36	brain and cognitive health	0	2022-11-02 15:57:06	2022-11-25 12:58:34	1
6	Ayurvedic Herbs	0	2022-09-08 19:59:25	2022-11-25 12:59:10	1
35	Men Health	0	2022-11-02 15:54:48	2022-11-25 13:10:04	1
25	sohum bioenergy	0	2022-10-29 13:06:04	2022-11-29 10:37:37	1
4	health and magnets	0	2022-09-07 20:46:36	2022-11-29 10:38:03	1
39	Bioenergy Health Products	0	2022-11-29 10:39:19	2022-11-29 10:39:19	0
\.


--
-- Data for Name: tbl_discounts; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.tbl_discounts (discount_id, discount_code, discount_percentage, created_at, updated_at, is_deleted) FROM stdin;
1	markertersdiscount	11	2022-10-29 19:01:53	2022-10-29 19:10:48	1
2	newmarkertersdiscount	29	2022-10-29 19:11:06	2022-11-18 23:08:11	0
\.


--
-- Data for Name: tbl_products; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.tbl_products (product_id, product_name, product_description, unit_price, category, stock_available, prodpriority, product_image, created_at, updated_at, is_deleted) FROM stdin;
20	GENETONIC	<ul>\r\n<li>helps to reduce fatigue&nbsp;</li>\r\n<li>maintain cellular strength and structure&nbsp;</li>\r\n<li>helps in bringing the body cells to a natural balance&nbsp;</li>\r\n<li>promotes natural healing&nbsp;</li>\r\n</ul>	3500	6	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664783999.JPG	2022-10-03 10:59:59	2022-11-25 12:59:10	1
11	siens zinc	<ul>\r\n<li>skin beautificatinon</li>\r\n<li>hair and nail growth</li>\r\n<li>brain nourisher</li>\r\n<li>powerful antioxidant</li>\r\n<li>boosts metabolism</li>\r\n<li>disease management</li>\r\n<li>nerve problems</li>\r\n<li>muscle growth and repair</li>\r\n<li>reproductive health</li>\r\n<li>nourishes body organs</li>\r\n<li>post surgery complicationa</li>\r\n<li>healing of wounds</li>\r\n</ul>	1500	5	200	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1663179668.jpg	2022-09-14 21:21:08	2022-09-14 21:21:08	0
9	siens evening primrose	<ul>\r\n<li>Skin beautification</li>\r\n<li>Hormonal balancing</li>\r\n<li>Weight management</li>\r\n<li>Depression and moods</li>\r\n<li>Chronic fatigue</li>\r\n<li>Nerve problems</li>\r\n<li>Heart problems</li>\r\n<li>Liver cleansing</li>\r\n<li>High blood pressure</li>\r\n<li>Joint problems</li>\r\n<li>Asthma and whooping cough</li>\r\n</ul>	1300	5	100	3	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1662658390.jpg	2022-09-08 20:33:10	2022-09-14 21:28:40	1
12	siens zinc	<ul>\r\n<li style="text-align: left;">skin beautificatinon</li>\r\n<li style="text-align: left;">hair and nail growth</li>\r\n<li style="text-align: left;">brain nourisher</li>\r\n<li style="text-align: left;">powerful antioxidant</li>\r\n<li style="text-align: left;">boosts metabolism</li>\r\n<li style="text-align: left;">disease management</li>\r\n<li style="text-align: left;">nerve problems</li>\r\n<li style="text-align: left;">muscle growth and repair</li>\r\n<li style="text-align: left;">reproductive health</li>\r\n<li style="text-align: left;">nourishes body organs</li>\r\n<li style="text-align: left;">post surgery complicationa</li>\r\n<li style="text-align: left;">healing of wounds</li>\r\n</ul>	1500	5	200	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1663179826.jpg	2022-09-14 21:23:46	2022-09-14 21:31:50	1
6	trial3	byukhjbjh	1	3	12	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1662491056.jpg	2022-09-06 19:04:16	2022-09-06 19:23:42	1
5	trial	truahsabud	1	3	11	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1662490595.jpg	2022-09-06 18:56:35	2022-09-06 19:26:18	1
8	siens omega 3	<ul>\r\n<li style="text-align: left;">Joint aches and pains</li>\r\n<li style="text-align: left;">Brain nourishment</li>\r\n<li style="text-align: left;">Healthy heart</li>\r\n<li style="text-align: left;">Eye problems</li>\r\n<li style="text-align: left;">Inflammatory disease</li>\r\n<li style="text-align: left;">Healthy metabolism</li>\r\n<li style="text-align: left;">Cancer management</li>\r\n<li style="text-align: left;">&nbsp;Anti aging and skin beautification</li>\r\n<li style="text-align: left;">high blood sugar management</li>\r\n<li style="text-align: left;">high blood pressure control</li>\r\n</ul>	1500	5	200	2	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1662658192.jpg	2022-09-08 20:29:52	2022-09-14 21:11:45	0
10	Siens Garlic	<ul>\r\n<li>Natural antibiotic for Body infections</li>\r\n<li>De- wormer</li>\r\n<li>Powerful ant oxidant</li>\r\n<li>Skin conditions</li>\r\n<li>Managing cholesterol</li>\r\n<li>High blood pressure</li>\r\n<li>Cancer management</li>\r\n</ul>	1200	5	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1662658860.jpg	2022-09-08 20:41:00	2022-09-14 21:12:11	0
43	blood pressure monitor	<p>high accuracy blood pressure monitor&nbsp;</p>	5000	16	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667044042.jpg	2022-10-29 14:47:22	2022-10-29 14:47:22	0
42	nebulizer	<p>high quality nebulizer&nbsp;</p>	1500	16	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667043620.jpg	2022-10-29 14:40:20	2022-10-29 14:54:24	0
44	blood sugar meter	<p>high level blood sugar check machine&nbsp;</p>	5000	16	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667044297.jpg	2022-10-29 14:51:37	2022-10-31 12:32:04	0
14	Aniel	<ul>\r\n<li>Allergies</li>\r\n<li>allergic rhinitis</li>\r\n<li>cold</li>\r\n<li>earache</li>\r\n<li>fever</li>\r\n<li>headache</li>\r\n<li>influenza</li>\r\n<li>malaria</li>\r\n<li>sasal congestion</li>\r\n<li>sinusitis</li>\r\n<li>tinnitus</li>\r\n<li>viral infections</li>\r\n</ul>	3800	22	10	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664032247.JPG	2022-09-24 18:10:47	2022-10-31 18:43:17	0
15	immune	<ul>\r\n<li>infections ( skin, lungs, skin,bones and joints, UTI)</li>\r\n<li>allergies</li>\r\n<li>asthma , bronchiitis and cough</li>\r\n<li>auto immune diseases &nbsp;</li>\r\n<li>improves blood circulation</li>\r\n<li>heaviness and discomfort in stomach</li>\r\n<li>indigestion</li>\r\n<li>regulates appetite</li>\r\n<li>&nbsp;</li>\r\n</ul>	3800	22	5	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664033451.JPG	2022-09-24 18:30:52	2022-10-31 18:43:50	0
18	DETOX C	<p>&nbsp;</p>\r\n<p>benefits&nbsp;</p>\r\n<ul>\r\n<li>coughs&nbsp;</li>\r\n<li>cold&nbsp;</li>\r\n<li>fever&nbsp;</li>\r\n</ul>	3500	22	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664783633.JPG	2022-10-03 10:53:54	2022-10-31 18:44:23	0
16	DESOLVE	<ul>\r\n<li>manages interstitial lung disorders&nbsp;</li>\r\n<li>detoxification of harmful toxins&nbsp;</li>\r\n<li>cancer as adjuvant therapy&nbsp;</li>\r\n<li>hypothyroidism&nbsp;</li>\r\n<li>fibroids&nbsp;</li>\r\n<li>goiter&nbsp;</li>\r\n<li>tumors&nbsp;</li>\r\n<li>lipoma( benign tumour of fatty tissue)</li>\r\n</ul>	4000	33	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664783110.JPG	2022-10-03 10:45:10	2022-11-01 14:16:03	0
17	DETOX	<ul>\r\n<li>cleansing and nourishing the body system&nbsp;</li>\r\n<li>healthy elimination of accumulated toxins&nbsp;</li>\r\n<li>reduces effects of colitis&nbsp;</li>\r\n<li>builds natural resistance agaisn micobes and their toxins&nbsp;</li>\r\n<li>manages irritable bowel sydrome i.e constipation, bloating and diarrhoea</li>\r\n</ul>	4000	33	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664783442.jpg	2022-10-03 10:50:42	2022-11-01 14:16:35	0
19	GENETONIC PLUS	<ul>\r\n<li>helps reduce fatigue&nbsp;</li>\r\n<li>maintain cellular strength and structure&nbsp;</li>\r\n<li>helps in bringing the body cells to a natural balance&nbsp;</li>\r\n<li>promotes natural healing&nbsp;</li>\r\n</ul>	3500	5	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664783859.JPG	2022-10-03 10:57:39	2022-11-01 14:44:04	0
13	siens evening primrose	<ul>\r\n<li>Skin beautification</li>\r\n<li>Hormonal balancing</li>\r\n<li>Weight management</li>\r\n<li>Depression and moods</li>\r\n<li>Chronic fatigue</li>\r\n<li>nerve problems</li>\r\n<li>liver cleansing</li>\r\n<li>high blood pressure</li>\r\n<li>joint problems</li>\r\n<li>asthma and whooping cough</li>\r\n</ul>	1300	5	200	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1663181540.jpg	2022-09-14 21:52:20	2022-11-02 15:59:50	0
33	HEALTH AND FITNESS	<p>high waist yoga leggings</p>	2500	7	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1666292042.jpg	2022-10-20 21:54:02	2022-10-20 21:55:59	0
34	DUMBBELL HAND WEIGHT	<p>Pretty easy hand weight that gives a healthy daily workout&nbsp;</p>	3000	7	5	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1666293026.jpg	2022-10-20 22:10:27	2022-10-20 22:10:27	0
35	bluetooth wireless weighing scale	<p>all in one weight tracker for&nbsp; BMI, skeletal muscle, and body fat percentage.</p>	5000	7	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1666293719.webp	2022-10-20 22:21:59	2022-10-20 22:21:59	0
36	health fit sense	<p>tracks your sleep, steps, heart rate, and more.</p>	30000	7	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1666294669.jpg	2022-10-20 22:37:49	2022-10-20 22:37:49	0
37	pillow massanger	<p>&nbsp;knead away knots in your neck and shoulders. It even heats up for extra relief.</p>	10000	7	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1666295055.jpg	2022-10-20 22:44:15	2022-10-20 22:44:15	0
38	yoga mat	<p>for yoga and other floor workouts&nbsp;</p>	3000	7	5	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1666295268.jpg	2022-10-20 22:47:49	2022-10-20 22:47:49	0
39	yoga mat	<p>exercise workouts mat&nbsp;</p>	5000	7	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1666295612.jpg	2022-10-20 22:53:32	2022-10-20 22:53:32	0
23	NOBESUS	<ul>\r\n<li>manages obesity&nbsp;</li>\r\n<li>improves cellulite appearance&nbsp;</li>\r\n<li>controls high cholesterol levels&nbsp;</li>\r\n<li>balances adipose tissues&nbsp;</li>\r\n<li>reduces excessive fluid trapped in the body&nbsp;</li>\r\n</ul>	4000	9	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664805602.JPG	2022-10-03 17:00:03	2022-10-31 18:49:50	0
40	Thermometer	<p>high accuracy thermometers&nbsp;</p>	2500	16	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667042888.webp	2022-10-29 14:28:08	2022-10-29 14:28:08	0
41	pulse oximeter	<p>hi accuracy pulse oximeter&nbsp;</p>	1500	16	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667043233.jpg	2022-10-29 14:33:54	2022-10-29 14:33:54	0
26	SAJAS	<ul>\r\n<li>Promotes vitality&nbsp;</li>\r\n<li>regulates hormonal imbalance&nbsp;</li>\r\n<li>eases&nbsp; menopausal transition</li>\r\n<li>manages anxiety and restlessness&nbsp;</li>\r\n<li>natural uterine tonic&nbsp;</li>\r\n<li>supports fertlity and healthy libido&nbsp;</li>\r\n</ul>	4000	17	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664806260.JPG	2022-10-03 17:11:00	2022-10-31 18:59:10	0
25	REJOIN	<ul>\r\n<li>joint pain&nbsp;</li>\r\n<li>joint numbness&nbsp;</li>\r\n<li>rejuvenates and strengthen the skeletal and neuromusscular system&nbsp;</li>\r\n<li>arthritis pain and swelling&nbsp;</li>\r\n<li>cleans toxins from joint tissue&nbsp;</li>\r\n<li>spondylosis&nbsp;</li>\r\n</ul>	4000	15	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664806035.JPG	2022-10-03 17:07:16	2022-10-31 19:06:33	0
27	SATHVA	<ul>\r\n<li>arthritis pain&nbsp;</li>\r\n<li>spondylitis&nbsp;</li>\r\n<li>backache&nbsp;</li>\r\n<li>fracture and sprains&nbsp;</li>\r\n<li>joint pain&nbsp;</li>\r\n<li>heal pain&nbsp;</li>\r\n<li>neck and spine pain&nbsp;</li>\r\n<li>stiffness of joints, muscles and spine.&nbsp;</li>\r\n</ul>	4000	15	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664806450.jpg	2022-10-03 17:14:11	2022-10-31 19:07:22	0
30	SUNIEL	<ul>\r\n<li>diabetic conditions&nbsp;</li>\r\n</ul>	4000	24	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664807095.JPG	2022-10-03 17:24:56	2022-11-01 14:39:11	0
29	SUKETU	<ul>\r\n<li>natural dewormer&nbsp;</li>\r\n<li>abdominal cramps and pain due to infection&nbsp;</li>\r\n</ul>	4000	33	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664806957.jpg	2022-10-03 17:22:37	2022-11-01 14:45:00	0
31	VAPIKA	<ul>\r\n<li>acute amoebiasis&nbsp;</li>\r\n<li>abdominal cramps&nbsp;</li>\r\n<li>irritable bowel syndrome&nbsp;</li>\r\n<li>diarrhea&nbsp;</li>\r\n</ul>	4000	33	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664807346.JPG	2022-10-03 17:29:06	2022-11-01 14:45:34	0
28	SUDHA	<ul>\r\n<li>natural calcium&nbsp;</li>\r\n<li>strengthens and build up bones&nbsp;</li>\r\n<li>tones muscular function&nbsp;</li>\r\n<li>builds up healthy blood&nbsp;</li>\r\n<li>manages hyperacidity&nbsp;</li>\r\n<li>aid s metabolism&nbsp;</li>\r\n<li>therapy for arthritis and joins&nbsp;</li>\r\n<li>urinary tract infections&nbsp;</li>\r\n</ul>	4000	15	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1669713737.png	2022-10-03 17:18:11	2022-11-29 12:22:17	0
24	palas	<ul>\r\n<li>eliminates toxins&nbsp;</li>\r\n<li>burning urination&nbsp;</li>\r\n<li>enlarged prostrate&nbsp;</li>\r\n<li>kidney related disorders&nbsp;</li>\r\n<li>urinary tract infections (UTI)</li>\r\n<li>prevents formation of calculi&nbsp;</li>\r\n</ul>	4000	34	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664805850.JPG	2022-10-03 17:04:10	2022-11-02 15:56:28	0
21	MANAS	<ul>\r\n<li>brain nourisher&nbsp;</li>\r\n<li>bipolar disorders&nbsp;</li>\r\n<li>brain fatigue, stress and strain&nbsp;</li>\r\n<li>improve cognitive and alertness&nbsp;</li>\r\n<li>improves concentration and memory span&nbsp;</li>\r\n<li>stiffnesss,&nbsp; pain of joints and muscles due to stress&nbsp;</li>\r\n</ul>	4000	11	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664805109.JPG	2022-10-03 16:51:49	2022-11-02 15:57:40	0
32	SVABAL	<ul>\r\n<li>health libido tonic&nbsp;</li>\r\n<li>immune enhancer&nbsp;</li>\r\n<li>erectile dysfunction&nbsp;</li>\r\n<li>premature ejaculation&nbsp;</li>\r\n<li>chronic fatigue&nbsp;</li>\r\n<li>increase vitality&nbsp;</li>\r\n<li>sexual debility&nbsp;</li>\r\n</ul>	9000	34	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664807613.jpg	2022-10-03 17:33:33	2022-11-02 16:02:18	0
45	large intestine detox(LID)	<p>indication&nbsp;</p>\r\n<ul>\r\n<li>thorough detox of the entire colon pathway</li>\r\n<li>assits in weight loss&nbsp;</li>\r\n<li>helps remove bad cholesterol&nbsp;</li>\r\n<li>unclogs the pathway, identifies and rids the accummulated junk&nbsp;</li>\r\n<li>prevents body toxicity&nbsp;</li>\r\n<li>assists better absorption of vitamin and nutirents&nbsp;</li>\r\n<li>strenngthens digestive system&nbsp;</li>\r\n<li>relieves obstinate constipation, bloating, gases&nbsp;</li>\r\n</ul>	4000	19	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667227602.png	2022-10-31 17:46:42	2022-10-31 18:18:27	0
22	NATZYME	<ul>\r\n<li>stimulates gastric enzymes and improves appetite</li>\r\n<li>eliminates digestive toxins&nbsp;</li>\r\n<li>promotes healthy digestion and absorptions&nbsp;</li>\r\n<li>regulates defecation and intestinal tract movement&nbsp;&nbsp;</li>\r\n<li>eases abdominal discomfort and consitipation due to gases&nbsp;</li>\r\n<li>maintains healthy acidity levels&nbsp;</li>\r\n</ul>	4000	19	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1664805420.JPG	2022-10-03 16:57:01	2022-10-31 18:35:19	0
46	Innate Immune	<p>age, poor nutrition, homonal imbalance, prolonged infections and prolonged ailment&nbsp;</p>\r\n<p>reduce our natural immunity. innate immune helps to restore the natural immunity&nbsp;</p>\r\n<p>benefits&nbsp;</p>\r\n<ul>\r\n<li>renewals body cells&nbsp;</li>\r\n<li>fights off pathogens&nbsp;</li>\r\n<li>combats viruses and bacteria&nbsp;</li>\r\n<li>battles foreign bodies&nbsp;</li>\r\n<li>helps prevent infections and disease&nbsp;</li>\r\n</ul>\r\n<p>&nbsp;</p>	4300	22	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667230897.png	2022-10-31 18:41:37	2022-10-31 18:41:37	0
47	Satavari	<ul>\r\n<li>hormonal balancing&nbsp;</li>\r\n<li>natural antioxidant&nbsp;</li>\r\n<li>natural immune booster&nbsp;</li>\r\n<li>stress reliever&nbsp;</li>\r\n<li>soothes gastrointestinal tract (GIT)</li>\r\n</ul>	5000	17	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667231907.jpg	2022-10-31 18:58:27	2022-10-31 18:58:27	0
48	Skin Detox	<p>indications&nbsp;</p>\r\n<ul>\r\n<li>removes toxins from skin&nbsp;</li>\r\n<li>reduces skin breakouts&nbsp;</li>\r\n<li>enhances skin texture&nbsp;</li>\r\n<li>prevents loss of excessive skin moisture&nbsp;</li>\r\n<li>eliminates black heads and pimples&nbsp;</li>\r\n<li>clears cold and sunburns&nbsp;</li>\r\n</ul>	4300	28	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667232895.png	2022-10-31 19:14:55	2022-10-31 19:14:55	0
49	Gulkand	<p>indications&nbsp;</p>\r\n<ul>\r\n<li>a powerful antioxidant&nbsp;</li>\r\n<li>has natural cooling properties&nbsp;</li>\r\n<li>reduces acidity and acid reflux&nbsp;</li>\r\n<li>assist in treating ulcers and prevents swelling in the intestines&nbsp;</li>\r\n<li>a good rejuvenator for the body&nbsp;</li>\r\n<li>excellent skin tonic&nbsp; for acne,pimples, skin breakouts, blackheads and rashes</li>\r\n<li>balances body PH&nbsp;</li>\r\n<li>Treats dyness of mouth, mouth ulcers&nbsp;</li>\r\n<li>strengthens teeth and gums&nbsp;</li>\r\n<li>assist in removing body odours with regular use&nbsp;</li>\r\n<li>helps in menstrual pain and excessive discharge&nbsp;</li>\r\n<li>reduces constipation, tiredness ,lethargy, itching, aches and pains.&nbsp;</li>\r\n</ul>	4000	19	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667233838.jpg	2022-10-31 19:30:38	2022-10-31 19:30:38	0
7	WHEATGRASS	<ul>\r\n<li style="text-align: left;">A super food</li>\r\n<li style="text-align: left;">detoxification and blood cleansing</li>\r\n<li style="text-align: left;">balances body PH</li>\r\n<li style="text-align: left;">clears constipation, acidity, bloating and nausea</li>\r\n<li style="text-align: left;">improves body immunity</li>\r\n<li style="text-align: left;">prevents cancer</li>\r\n<li style="text-align: left;">manages blood pressure</li>\r\n<li style="text-align: left;">controls high pressure</li>\r\n<li style="text-align: left;">anti-inflammatory for joints</li>\r\n<li style="text-align: left;">manages ulcers</li>\r\n<li style="text-align: left;">sooths tooth decay</li>\r\n<li style="text-align: left;">facial cleanser</li>\r\n</ul>	1500	5	200	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1662657957.jpg	2022-09-08 20:25:57	2022-11-01 14:03:48	0
50	Anar G	<p>Indications&nbsp;</p>\r\n<ul>\r\n<li>removes bad cholesterol&nbsp;</li>\r\n<li>manages weight&nbsp;</li>\r\n<li>purifies blood&nbsp;</li>\r\n<li>reduces blood&nbsp;</li>\r\n</ul>	5000	9	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667302329.png	2022-11-01 14:32:09	2022-11-01 14:32:09	0
51	Svabal GOld	<ul>\r\n<li>health libido tonic&nbsp;</li>\r\n<li>immune enhancer&nbsp;</li>\r\n<li>erectile dysfunction&nbsp;</li>\r\n<li>premature ejaculation&nbsp;</li>\r\n<li>chronic fatigue&nbsp;</li>\r\n<li>increase vitality&nbsp;</li>\r\n<li>sexual debility</li>\r\n</ul>	9000	34	3	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667394471.jpg	2022-11-02 16:07:52	2022-11-02 16:07:52	0
52	Vitamin C	<p>&nbsp;</p>\r\n<ul>\r\n<li>high potency</li>\r\n<li>helps body form collagen naturally</li>\r\n<li>helps maintain cartilage, bones and teeth &nbsp;</li>\r\n<li>protects cells against free radicals&nbsp;</li>\r\n<li>improves iron absorption&nbsp;</li>\r\n<li>promotes vitality&nbsp;</li>\r\n<li>boost immunity&nbsp;</li>\r\n<li>reduces risk of heart disease&nbsp;</li>\r\n<li>reduces&nbsp; risk of dementia</li>\r\n<li>helps maintain healthy blood pressure&nbsp;</li>\r\n</ul>	1500	5	5	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667398966.jpg	2022-11-02 17:22:46	2022-11-02 17:38:29	0
53	posture shoulder belt	<p>posture shoulder belt for correcting posture&nbsp;</p>	4000	7	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667471497.webp	2022-11-03 13:31:37	2022-11-03 13:31:37	0
54	Flax Seeds	<p>benefits&nbsp;</p>\r\n<ul>\r\n<li>helps in balancing hormones&nbsp;</li>\r\n<li>improves digestive health&nbsp;</li>\r\n<li>helps lower blood cholesterol&nbsp;</li>\r\n<li>reduces risk of heart disease&nbsp;</li>\r\n</ul>	750	37	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667477175.jpg	2022-11-03 15:06:15	2022-11-03 15:06:15	0
55	pumpkin seeds	<p>Benefits&nbsp;</p>\r\n<ul>\r\n<li>has vitamins and minerals that help in wound healing&nbsp;</li>\r\n<li>has lots of zinc that helps fight bacteria and viruses&nbsp;</li>\r\n<li>gives healthy bone density and is highly rich in calcium and magnesium&nbsp;</li>\r\n<li>helps reduce osteoporosis&nbsp;</li>\r\n<li>30grams a day considered a healthy diet&nbsp;</li>\r\n<li>&nbsp;</li>\r\n</ul>	750	37	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667477659.jpg	2022-11-03 15:14:19	2022-11-03 15:14:19	0
56	Sesame Seeds	<p>Benefits&nbsp;</p>\r\n<ul>\r\n<li>gives healthy fats&nbsp;</li>\r\n<li>protein B vitamins, minerals, fiber and antioxidants&nbsp;</li>\r\n<li>helps maintain healthy blood sugars&nbsp;</li>\r\n<li>combats arthritis and gives healthy joins&nbsp;</li>\r\n<li>help in lowering cholesterol&nbsp;</li>\r\n</ul>	750	37	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667477912.jpg	2022-11-03 15:18:32	2022-11-03 15:20:45	0
57	Chia Seeds	<p>Health Benefits&nbsp;</p>\r\n<ul>\r\n<li>high in fiber hence reduce constipation&nbsp;</li>\r\n<li>a good antioxidant that help reduce chance of disease&nbsp;</li>\r\n<li>has calcium and omega three for strong bones</li>\r\n</ul>	750	37	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667478450.jpg	2022-11-03 15:27:30	2022-11-03 15:27:30	0
58	Sunflower Seeds	<ul>\r\n<li class="TrT0Xe">Good for&nbsp; heart. </li>\r\n<li class="TrT0Xe">High in antioxidants.&nbsp;</li>\r\n<li class="TrT0Xe">May help promote healthy blood sugar levels. ...</li>\r\n<li class="TrT0Xe">Rich in minerals.&nbsp;</li>\r\n</ul>\r\n<p><span class="ILfuVd" lang="en"><span class="hgKElc"><strong>&nbsp;</strong></span></span></p>	750	37	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667478871.jpg	2022-11-03 15:34:31	2022-11-03 15:34:31	0
59	Quinoa seeds	<p>Benefits&nbsp;</p>\r\n<ul>\r\n<li class="TrT0Xe">May lower the risk of chronic disease. ...</li>\r\n<li class="TrT0Xe">May help you lose weight. ...</li>\r\n<li class="TrT0Xe">May help balance blood sugar. ...</li>\r\n<li class="TrT0Xe">Suitable for those with coeliac disease and gluten intolerance. ...</li>\r\n<li class="TrT0Xe">May improve gut health.</li>\r\n</ul>	750	37	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1667479138.jpg	2022-11-03 15:38:58	2022-11-03 15:38:58	0
60	Eye Flames&Lenses	<p>Eye Care&nbsp;</p>	1350	26	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1669369032.jpg	2022-11-25 12:37:12	2022-11-25 12:37:12	0
61	genetonic	<p>Indications&nbsp;</p>\r\n<ul>\r\n<li>reduces fatigue&nbsp;</li>\r\n<li>maintain cellular strength and structure&nbsp;</li>\r\n<li>helps to bring body cells to natural balance&nbsp;</li>\r\n<li>promotes natural healing&nbsp;</li>\r\n</ul>	3500	5	2	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1669370735.JPG	2022-11-25 13:05:35	2022-11-25 13:05:35	0
62	GENETONIC PLUS	<ul>\r\n<li>restores damaged cells&nbsp;</li>\r\n</ul>	3500	5	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1669370901.JPG	2022-11-25 13:08:21	2022-11-25 13:08:21	0
63	Ab-slim wrap	<p>health benefits</p>\r\n<ul>\r\n<li>Obesity : reduces excess fats&nbsp;</li>\r\n</ul>\r\n<p>boosts up metabolism activities and burns up</p>\r\n<p>excess fatty tissues around abdomen</p>	25500	39	1	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1669709225.jpg	2022-11-29 11:07:05	2022-11-29 11:07:05	0
64	free	<p>Free time</p>	1100	14	0	1	https://siens-africa.s3.amazonaws.com/public/assets/uploads/products/1670482199.png	2022-12-08 09:49:59	2022-12-08 09:59:07	0
\.


--
-- Data for Name: tbl_queries; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.tbl_queries (query_id, user_id, question, created_at, updated_at, is_deleted) FROM stdin;
\.


--
-- Data for Name: tbl_roles; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.tbl_roles (role_id, role_name) FROM stdin;
1	Admin
2	Client
3	Marketer
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: prbqnyfvyfsexb
--

COPY public.users (user_id, firstname, surname, email, country, email_verified_at, telephone, role_as, password, remember_token, created_at, updated_at, is_deleted) FROM stdin;
5	Kelvin	Wachira	kelvingertler@gmail.com	KENYA	\N	725009085	2	$2y$10$mjtDZ4j7TpBWG9X8XsCNeuDx1.VeOSleQ7wLp684RA07xaBAJF6bu	\N	2022-09-06 11:18:10	2022-09-06 11:18:10	0
7	mash	mash	masha@email.com	KENYA	\N	771934250	1	$2y$10$17HHh3IzQTly/18niqbVf.2rCETzd5naJ2vaoWMYKAbOF3wvi.OqG	\N	2022-09-07 17:07:37	2022-09-07 17:07:37	0
2	admin	two	admin1@email.com	KENYA	\N	777939699	1	$2y$10$.J3Mi7O0KUoG8rPOt4/I..4phouhI9wlQQSikYiADxee/sZWzAlh.	\N	2022-09-05 19:02:02	2022-09-07 17:17:00	0
6	margaret	admin	info@sienshealth.com	KENYA	\N	716615207	1	$2y$10$6kn5GPUduCyzbWS3oI.pdOU8cVWULtIS/t1HFDxVVYJlMjLb.BaTa	\N	2022-09-07 16:31:58	2022-09-07 20:50:53	0
12	margaret	macharia	mmwachi@yahoo.com	KENYA	\N	721412955	2	$2y$10$DuEUDCc.pntFYxL2Jdzbj.7xlyeYGR6iiA51N2X3du4o7okQOGvpu	\N	2022-09-14 19:44:16	2022-09-14 19:44:16	0
13	Daniel	Kariuki	driri14@gmail.com	KENYA	\N	729535505	2	$2y$10$eE7NDVXDfQoRv9srB7RlGelGP.ixRdyWDz5SaW0szyqyKQyEVqGPK	\N	2022-09-15 10:36:44	2022-09-15 10:36:44	0
14	Mary	John	marykyeny@gmail.com	KENYA	\N	722576847	2	$2y$10$FaoyCDHQ3U6vB2o39OaGKe9hOS1jgmfz4Bw4Y7U1IThEBZsegttii	\N	2022-10-16 23:14:24	2022-10-16 23:14:24	0
15	NIVEDITA	D	sahajsohum@gmail.com	KENYA	\N	712290382	2	$2y$10$oWZjtJddQok/DYHqGE4AkeZVaX68D5ysO1rABEXEs5X7lKMf5r5D.	\N	2022-10-27 11:44:56	2022-10-27 11:44:56	0
16	Beth	muriu	bethmuriu@gmail.com	KENYA	\N	700126349	3	$2y$10$v6Q4hzwgMT45RrE53xP0PuLKOijGrHGRMeP/vJUKtFYbfCnksZjLi	\N	2022-11-15 13:28:20	2022-11-18 22:38:17	0
17	Elizabeth	Muriuki	lizmuthonimuriuki@gmail.com	KENYA	\N	711150115	2	$2y$10$D7GqQ75Gdp3sd.jGH4rfLeZQURq.Ow.3b3IljSok5psMXtZ0Up8wS	\N	2022-11-26 19:23:07	2022-11-26 19:23:07	0
1	user	two	user@email.com	KENYA	\N	757769602	2	$2y$10$QN9gXJgJaOkNC9Usw7YDuOcDY4ByFNoQ4IoMHnMd1bfslsdsozTRS	\N	2022-09-05 19:01:33	2022-12-08 09:51:13	0
\.


--
-- Name: country_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.country_id_seq', 1, false);


--
-- Name: delivery_delivery_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.delivery_delivery_id_seq', 6, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: fquery_query_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.fquery_query_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.migrations_id_seq', 15, true);


--
-- Name: orderdetails_orderdetails_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.orderdetails_orderdetails_id_seq', 6, true);


--
-- Name: orders_order_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.orders_order_id_seq', 6, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: pesapal_payments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.pesapal_payments_id_seq', 10, true);


--
-- Name: tbl_categories_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.tbl_categories_category_id_seq', 39, true);


--
-- Name: tbl_discounts_discount_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.tbl_discounts_discount_id_seq', 2, true);


--
-- Name: tbl_products_product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.tbl_products_product_id_seq', 64, true);


--
-- Name: tbl_queries_query_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.tbl_queries_query_id_seq', 1, true);


--
-- Name: tbl_roles_role_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.tbl_roles_role_id_seq', 1, false);


--
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: prbqnyfvyfsexb
--

SELECT pg_catalog.setval('public.users_user_id_seq', 17, true);


--
-- Name: country country_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.country
    ADD CONSTRAINT country_pkey PRIMARY KEY (id);


--
-- Name: delivery delivery_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.delivery
    ADD CONSTRAINT delivery_pkey PRIMARY KEY (delivery_id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: fquery fquery_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.fquery
    ADD CONSTRAINT fquery_pkey PRIMARY KEY (query_id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: orderdetails orderdetails_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.orderdetails
    ADD CONSTRAINT orderdetails_pkey PRIMARY KEY (orderdetails_id);


--
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (order_id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: pesapal_payments pesapal_payments_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.pesapal_payments
    ADD CONSTRAINT pesapal_payments_pkey PRIMARY KEY (id);


--
-- Name: tbl_categories tbl_categories_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.tbl_categories
    ADD CONSTRAINT tbl_categories_pkey PRIMARY KEY (category_id);


--
-- Name: tbl_discounts tbl_discounts_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.tbl_discounts
    ADD CONSTRAINT tbl_discounts_pkey PRIMARY KEY (discount_id);


--
-- Name: tbl_products tbl_products_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.tbl_products
    ADD CONSTRAINT tbl_products_pkey PRIMARY KEY (product_id);


--
-- Name: tbl_queries tbl_queries_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.tbl_queries
    ADD CONSTRAINT tbl_queries_pkey PRIMARY KEY (query_id);


--
-- Name: tbl_roles tbl_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.tbl_roles
    ADD CONSTRAINT tbl_roles_pkey PRIMARY KEY (role_id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


--
-- Name: users users_telephone_unique; Type: CONSTRAINT; Schema: public; Owner: prbqnyfvyfsexb
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_telephone_unique UNIQUE (telephone);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: prbqnyfvyfsexb
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: SCHEMA heroku_ext; Type: ACL; Schema: -; Owner: u3mccd13p8g100
--

GRANT USAGE ON SCHEMA heroku_ext TO prbqnyfvyfsexb;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: prbqnyfvyfsexb
--

REVOKE ALL ON SCHEMA public FROM postgres;
REVOKE ALL ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO prbqnyfvyfsexb;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: LANGUAGE plpgsql; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON LANGUAGE plpgsql TO prbqnyfvyfsexb;


--
-- PostgreSQL database dump complete
--

