-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Lug 27, 2019 alle 21:07
-- Versione del server: 10.1.30-MariaDB
-- Versione PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fxjournal`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Order`
--

CREATE TABLE `Order` (
  `idOrder` int(11) NOT NULL,
  `orderType` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Order`
--

INSERT INTO `Order` (`idOrder`, `orderType`) VALUES
(1, 'BUY'),
(2, 'SELL');

-- --------------------------------------------------------

--
-- Struttura della tabella `Pair`
--

CREATE TABLE `Pair` (
  `idPair` int(11) NOT NULL,
  `pairName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Pair`
--

INSERT INTO `Pair` (`idPair`, `pairName`) VALUES
(1, 'EUR/USD'),
(2, 'USD/JPY');

-- --------------------------------------------------------

--
-- Struttura della tabella `System`
--

CREATE TABLE `System` (
  `idSystem` int(11) NOT NULL,
  `systemInfo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `Trade`
--

CREATE TABLE `Trade` (
  `idTrade` int(11) NOT NULL,
  `tradeEntryDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tradeExitDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tradeEntryPrice` decimal(10,0) NOT NULL,
  `tradeExitPrice` decimal(10,0) NOT NULL,
  `tradeLots` decimal(10,0) DEFAULT NULL,
  `tradePips` int(11) NOT NULL,
  `tradeDescription` varchar(1000) DEFAULT NULL,
  `System_idSystem` int(11) DEFAULT NULL,
  `Order_idOrder` int(11) NOT NULL,
  `Pair_idPair` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `Trade`
--

INSERT INTO `Trade` (`idTrade`, `tradeEntryDate`, `tradeExitDate`, `tradeEntryPrice`, `tradeExitPrice`, `tradeLots`, `tradePips`, `tradeDescription`, `System_idSystem`, `Order_idOrder`, `Pair_idPair`) VALUES
(9, '2019-07-22 18:50:34', '2019-07-22 18:50:34', '1', '2', '3', 4, NULL, NULL, 1, 1),
(10, '2019-07-22 18:50:45', '2019-07-22 18:50:45', '1', '2', '3', 4, NULL, NULL, 1, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Order`
--
ALTER TABLE `Order`
  ADD PRIMARY KEY (`idOrder`);

--
-- Indici per le tabelle `Pair`
--
ALTER TABLE `Pair`
  ADD PRIMARY KEY (`idPair`);

--
-- Indici per le tabelle `System`
--
ALTER TABLE `System`
  ADD PRIMARY KEY (`idSystem`);

--
-- Indici per le tabelle `Trade`
--
ALTER TABLE `Trade`
  ADD PRIMARY KEY (`idTrade`,`Order_idOrder`,`Pair_idPair`),
  ADD KEY `fk_Trade_System_idx` (`System_idSystem`),
  ADD KEY `fk_Trade_Order1_idx` (`Order_idOrder`),
  ADD KEY `fk_Trade_Pair1_idx` (`Pair_idPair`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Pair`
--
ALTER TABLE `Pair`
  MODIFY `idPair` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `System`
--
ALTER TABLE `System`
  MODIFY `idSystem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Trade`
--
ALTER TABLE `Trade`
  MODIFY `idTrade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Trade`
--
ALTER TABLE `Trade`
  ADD CONSTRAINT `fk_Trade_Order1` FOREIGN KEY (`Order_idOrder`) REFERENCES `Order` (`idOrder`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Trade_Pair1` FOREIGN KEY (`Pair_idPair`) REFERENCES `Pair` (`idPair`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Trade_System` FOREIGN KEY (`System_idSystem`) REFERENCES `System` (`idSystem`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
