# Infrastruktur Basis Data Terdistribusi dengan Skema Replikasi Multi-Master

#### Vinsensius Indra Suryanto 05111640000064

## Table of Contents
- [Infrastruktur Basis Data Terdistribusi dengan Skema Replikasi Multi-Master](#infrastruktur-basis-data-terdistribusi-dengan-skema-replikasi-multi-master)
  - [Table of Contents](#table-of-contents)
  - [Desain dan Implementasi Infrastruktur](#desain-dan-implementasi-infrastruktur)
  - [Penggunaan Basis Data Terdistribusi dalam Aplikasi](#penggunaan-basis-data-terdistribusi-dalam-aplikasi)
  - [Simulasi fail-over](#simulasi-fail-over)

## Desain dan Implementasi Infrastruktur

### Desain infrastruktur basis data terdistribusi & load balancing

- Skema Infrastruktur

<img src="assets/infrastruktur.png" alt="Gambar Desain Infrastruktur" width="350"/>

- Penjelasan
    - Server DB
        1. rdbs1 (MySQL)
            - OS    : Ubuntu 18.04.3 LTS
            - RAM   : 512 MB
            - CPUs  : 1
            - IP    : 192.168.16.64
        2. rdbs2 (MySQL)
            - OS    : Ubuntu 18.04.3 LTS
            - RAM   : 512 MB
            - CPUs  : 1
            - IP    : 192.168.16.65
        3. rdbs3 (MySQL)
            - OS    : Ubuntu 18.04.3 LTS
            - RAM   : 512 MB
            - CPUs  : 1
            - IP    : 192.168.16.66
    - Load Balancer
        1. lb1 (ProxySQL)
            - OS    : Ubuntu 18.04.3 LTS
            - RAM   : 512 MB
            - CPUs  : 1
            - IP    : 192.168.16.67
    - Web Server
        1. web1 (apache2)
            - OS    : Ubuntu 18.04.3 LTS
            - RAM   : 512 MB
            - CPUs  : 1
            - IP    : 192.168.16.68

## Penggunaan Basis Data Terdistribusi dalam Aplikasi

WIP

## Simulasi fail-over

WIP