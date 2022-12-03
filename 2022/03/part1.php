<?php
/**
 * --- Day 3: Rucksack Reorganization ---
 *
 * One Elf has the important job of loading all of the rucksacks with supplies
 * for the jungle journey. Unfortunately, that Elf didn't quite follow the
 * packing instructions, and so a few items now need to be rearranged.
 *
 * Each rucksack has two large compartments. All items of a given type are meant
 * to go into exactly one of the two compartments. The Elf that did the packing
 * failed to follow this rule for exactly one item type per rucksack.
 *
 * The Elves have made a list of all of the items currently in each rucksack
 * (your puzzle input), but they need your help finding the errors. Every item
 * type is identified by a single lowercase or uppercase letter (that is, a and
 * A refer to different types of items).
 *
 * The list of items for each rucksack is given as characters all on a single
 * line. A given rucksack always has the same number of items in each of its two
 * compartments, so the first half of the characters represent items in the
 * first compartment, while the second half of the characters represent items in
 * the second compartment.
 *
 * For example, suppose you have the following list of contents from six
 * rucksacks:
 *
 * vJrwpWtwJgWrhcsFMMfFFhFp
 * jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL
 * PmmdzqPrVvPwwTWBwg
 * wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn
 * ttgJtRGJQctTZtZT
 * CrZsJsPPZsGzwwsLwLmpwMDw
 *
 * - The first rucksack contains the items vJrwpWtwJgWrhcsFMMfFFhFp, which means
 *   its first compartment contains the items vJrwpWtwJgWr, while the second
 *   compartment contains the items hcsFMMfFFhFp. The only item type that
 *   appears in both compartments is lowercase p.
 * - The second rucksack's compartments contain jqHRNqRjqzjGDLGL and
 *   rsFMfFZSrLrFZsSL. The only item type that appears in both compartments is
 *   uppercase L.
 * - The third rucksack's compartments contain PmmdzqPrV and vPwwTWBwg; the only
 *   common item type is uppercase P.
 * - The fourth rucksack's compartments only share item type v.
 * - The fifth rucksack's compartments only share item type t.
 * - The sixth rucksack's compartments only share item type s.
 *
 * To help prioritize item rearrangement, every item type can be converted to a
 * priority:
 *
 * - Lowercase item types a through z have priorities 1 through 26.
 * - Uppercase item types A through Z have priorities 27 through 52.
 *
 * In the above example, the priority of the item type that appears in both
 * compartments of each rucksack is 16 (p), 38 (L), 42 (P), 22 (v), 20 (t), and
 * 19 (s); the sum of these is 157.
 *
 * Find the item type that appears in both compartments of each rucksack. What
 * is the sum of the priorities of those item types?
 */

function dup(string $list) {
   $half = strlen($list)/2;

   $index = [];
   $dups = [];

   for ($i=0; $i < $half; $i++) {
      $index[$list[$i]] = true;
   }

   for ($i=$half; $i < strlen($list); $i++) {
      if ($index[$list[$i]] ?? false) {
         $dups[] = $list[$i];
      }
   }

   return array_unique($dups);
}

function priority(array $list) {
   $priority = array_merge(
      range('a', 'z'),
      range('A', 'Z'),
   );

   $res = [];
   foreach($list as $k => $c) {
      $res[] = array_search($c, $priority) + 1;
   }

   return $res;
}

function score(string $input) {
   $prios = [];

   foreach (explode("\n", $input) as $line) {
      $dups = dup($line);
      $prios = array_merge($prios, priority($dups));
   }

   return array_sum($prios);
}

$input = <<<EOL
vJrwpWtwJgWrhcsFMMfFFhFp
jqHRNqRjqzjGDLGLrsFMfFZSrLrFZsSL
PmmdzqPrVvPwwTWBwg
wMqvLMZHhHMvwLHjbvcjnnSBnvTQFn
ttgJtRGJQctTZtZT
CrZsJsPPZsGzwwsLwLmpwMDw
EOL;

$input = <<<EOL
mmbclcsDHCflDDlCrzzrDWjPJvjPvqJPjfpqZQdfWd
NNFLnFRNhgNQtMLSFSgwSwGJPZWLPvjpjjJGZJPvWPvJ
BnwFNgVVhwNwVQrmzbrrCHVTmDsm
CTsVssjPTWPbzhfbfqqpbqJq
RRttdQlRdnNpdmwBnBDhFrGrqDGBqJJfJD
HttgcggdNwQtgcpTsvjVPTcssjsv
bWrpnrpPcFNbfPtwVPddVVDw
jLgqqJgjZLhHjRqLHLjqHgftpmJVtTmwQmtGddwwDVJm
HhzgshZLpHLjqhLLZRZpLRbbrlBNsrrNsFWcCvvFCcNN
PCJJfJhjhzjjdBVBcd
RnNnMHnRNtWnBSQHVbqSzFcq
ZlnZZZNmLrNrgZmmccGJwGwmGPJs
hFZLsjjjMzwPPjqw
SQtTcpWWcpMSDlQpDCQJqbHzdSzPzJvPPwqqvH
tVfpGWGDVlCGGDCpVWppVcrZFMrnmnLfsrBrnngLmMBh
PFPhCmpfhSMWnmgrtgMW
RRQdGQvTQRzQDGQTQcRqTTQLvsntnltvrWZlsWlZftntrMtt
NQTzfGfzcdTBhPJSNJbCCVhJ
sbtqfrqNfcdqsJrfhzQmzhpvzvpQmpNG
SHsSDsZVHBHnRZDBZRWSVDnwFhzvphggwGhQzQhgwzmmPzmg
jjHVHBlHljMsJjbbCcdttc
NccBbvbNZbbvBGPVTGhhlCZCPg
tdWHQtLLMrrdWQRqWrMrMrMPsTPThDlTssFFCFCVTDtCDC
zzWmMQQLVQrWrbBczNnwNbnpnN
THGhBHgHThvnHRrQRpMNSwZSMrwD
szsCzWljNfVFFVllPPzzVWJMJZQMJbpSrwQCCJMDZbbb
WzlfFlflfcmfsFPVfWVVhnNgchHndHgdTnqdNHTh
zPhDwsWgszftMNfPjjLL
RTRbbJFHSrqRRrHRrjGQBnfjQQMjLnmNnF
ddpNSNNpSdWsvpllWzsl
FgDgbSMnhhntCLCC
HlqzJgPfJJgmrthhrtTLqL
fjfQgJPGVjwGJcFMcSvdScWjMD
pnFwRPlVVlLSwpGbvSmZHmbbdbHm
sCzTQtzrrQMzpthTdvbGHdvdHNsZqqqZ
ChTTWhWBWCDrrTrjCrhtLwwLFgfLFgjnpfpwLnVg
MRDfBDMJsQdmGWsM
pFPqwswhGzWSCwGN
jphpbgbqgFnqjjnthLtJsZfJRHfllfTllDLflJ
sdbLCqnbllplrdrsqbZHRPRBcBcBZBcHcZrM
JJFwDDQmzfmhmWhJhwFWbMbcNBNRBBzbNPHcMHPj
DFWVQVGGGbpGClllqLSl
mRmFhZRsmFJfFRzwRrFrqmRFtNLLDTPccVqVtGTLDnPccPDN
SBddBlZMjpQvvBbZvVDTtDTDDVGnLTMPVT
dCHWlbHbdbllsRCCgFwrrZCJ
hwvwFHhlTLwpLDQhpHwTwBLSfvzSZZsvVsqCGqzZSfCvVG
WNdtmjPjcWdWJWntcWbjzmFzrrVrzsGzsVsSVrZZ
PbJPntMRbbdJbcNPcNFjnhlwwgpDHRBpggTlQThhpQ
mJvRGHfWmvWJJVmZZnZVffpglGggrTLNzLwNLrszzNpz
FqFMMShqjcMcqPbbjPthNgRggPgLwPsgLgszwNpl
DFQqQMhRhDRmWndDnJvmWW
jVzfvzSVpnnNSGjjVpNlSNDzqBBmWCBtWWtfFFCCmPmJCCJW
HLrRLhwrMZbHrWqWBhGPCGBFJW
wHHMRMQRQrcQRTTcHrwwRcQbDnpvnppzGSnvnSNzDSNTpjnS
qzrgfppGzPDJHfbZbHZn
vTsMvMTclhNlFlFhdhdqHHmHJSJDVJnJFFwJHHDn
slccWTTTcdCcCqRQPrzgBWPPRz
thfHHdDwbnVzwwdthZlqjZmmTmjfZcfMQl
sGFGJFFvGpFPCJvLPGPgZlpmlTMcmlmZrmMjcr
sJGLSWRSPBBCCPRFWPsNBNwMNNVMNwBzzMDhnh
RwJMwdbzMGWbLtLVQpPl
gqNfBmBjNmcCqjqjQllWhhQlgDQtpWlh
cfccjmcNmHrHBmCBcTMGtTJtZzrTvddRGR
vbbvqMhcrqMQQLHHvFvHHvpPlnPLfVfPnfmwsNwwwlnVls
ZdBZZgDRDzBRJWBzzDZjDDNWNnNnPfwNPwmSwlnCnfCW
JgRggTDtZmmbbFqrvT
lSgzfSzgGcNfDPsbMpspbPnnrrVV
FmWFBFQHBJJBmmWJFHWFrwtsVrMbnrVVwwwpWMMp
FFmmJmvZjQBRQRRQZQBvNNglRhDNDffDSDSMGlDD
VQPBCZVfHQZGRVVpmzPFmgSgbSPTFb
NcwLjcWnFhCpLvCF
tNCDtsqltDwtWdncJZVJVRMGdBQffHZH
pTzgPsLQfMLqTVFLGbVbbFVJVF
ZnjgjvSwNNbFJVwN
jWcCnWHWRvWRHHnWRWjvdZnZtspMqfzrMqfQtTPQgfPzfzcM
CTqHMNSSVnpjNSTFzMwPdslwnlPccbblgcbd
WDLqvLQRfLBgbJPwlWgdPd
QRBqqDmZZRBGGfCTpCCSMSmzjSpz
bPlRhmnPhTwhrvrlRrjgLjgsLpszFldgFlgF
tGHWfcQHWfLZnsLQnjpn
cVGtCtGGcNWcWtBStqnWrwmvmbmJwJPwbRBhRRMb
BjVTVfBsLlLjLcBcZDRJpnJRDPRJqlPRqJ
SzbQMQzFgfFzmMSrbzGpqqRDtqmnvDHtvppHDm
CrSQSdgrWdbFQCWggjWZTfBWcwBcTVBjTs
RtqdCqCTbRfRbbHR
FhwWWqgGJJgJHLHPFFsDbsFP
MrpmmwqhMmJMwpvlNvtlTrvtZSSr
VscvcmcmbhDrRMCCJlqnSlJnSljR
FWdwWgpZgdBLTgTWFwZBgWpjbCNqPptCSlNCStnSJJNPPJ
FdFWGgWTQGGbGvvDHDHzMD
WhhBJrBqBchcQBBqcqqGRZRlrtStlSlRszlzSSRl
fHdwgdjbNCbCCHNgPgHNPNplSRtQtltlRDZsQfZsZMRQMR
jQbQNwVNvWFJvqcV
bjbmmgSjwTWqWwWqcw
sQGfPZQDPqMMWWWd
fqBDfqqZZGHGDsNLjtmlttpgBllpJt
ZDmCWtftfWBLfRDWwbhqcNNtqwjtjwqt
SnTTsnlPMTlSSsGMMSddSbHjhwJwwjPbcvHwLwcqjj
GrFGzSgnTzLgDVfQfQrrDDfm
PngprCCmcBDssRFBSbFRRs
fjwHtjfNWfGwHfdtjGMdWSSdQTsQRLFSSslPSFTRlS
jGjMwMffWHNZfhwnDzqCpZDgrqCcPr
qzGPbzbDZGSPvpvrTvQsQwLWWNLj
tFddBhgnVnMMhBhLJWLwjQMwMrMLwT
BHFtVHgtmlhRRZmSTDTpSq
ZwzLWWWvWdSJdJQwQLzBqqbbhhCcNzchqCNPhb
rHfDRfHGfHsGTPPmhmrrNhjmNg
GlfsfRTfsfRtsstfDVHpGsPSFQJSWQMJwdSLwQWpZZLd
vnvJvpJtQwDBTljHlLHhDL
zzGqMwqMqbfRfVGzFmLmLTLddjmTSRLBBB
zGfrbqzwNvPPcCtr
jwCwSgvPSmCwSqwgbCRQGvsRVnddGZdflsfB
MhzHLWpMWHHzNzMccDHdnZVZRZRGQnGlGRGLsZ
nccNHTzWHDcMWHcphpptDrcDJmSgFTPjgPFjTjgSbqJSJqbg
bVhPWqBBbdbdPqVVqhSfpcmFsfwLnmmjnfBFmn
TDWDGzgRvrNJJJrzzzGspwpjncsncFmwFmsNfw
vMDgDJRWgDJtHDJMMPQQMdQlqdlhZZQbbC
SpdpQqLwrDcmPhggcS
ZHCZstHMhjGmtPDc
NNnnRHMZNzTMHZZTTsZMvvRhJJwWzBVLVQJJqWwVhwJpdJ
mrlMQlQPPPhhCbZRNpRZcffmFmgc
VvJVJqDqvqjDqvtVttVSHTTHLLcggBNBBSRRFfRLncfFLpBB
jHVHvdDHtJjtDWjwMhWwhwwwlNswPr
MJvzvFLhbTnJCvRwWSTmSWWWmRpc
tlVlNqBsVNNBQPrWgqmcgfwpcWpdcg
ZBjHPsttQrPrrVsBQpVJzhZhvnnbMMLvFJJZMJ
hBfJffJJNhnDlmQdnmSGcd
sQrCpRsPCrwFZQprpQCzljdjMMjMGGdGSmgSFFDS
zZpzQpwzHRPPTrQwCpRzWZHqLVvtBJvbBtVJhJLhHtLbVv
DsPnQGnnwlVJbSsb
HCfCfTDMTfHvCWMZDcRVVSwpbtlhVZbhhpVllp
TmCMTvfjRCCvcrgNNPQDmNzrLF
ghwNtnMMRTZtwTphjjBQfLJjfJFdSBTL
lldzbqzrCrfLJJBBbSWj
DCvlvqvshNhRndGs
rWwWWDJWWrFLdRWtRhFZTCbCSqThFTCbmm
BgMvSzvMpVpBlQNQVgfqhhGCbGbThQZTcbZTCs
nMpfjVMnzlgRSrnHnwdSDH
blFhFgFgPLvjDwNvWPnD
qMBzMCCzZMzJHRrzMFZsnFjQdZnvvNvvWQ
FzpMpGMRrlSSghLhtG
hDlVfDdSTjTJwjMTZT
HgnqtGgQRgRHGtrgqgSZJCrwBZZCrZwWJWjMWZ
zqRbGNSbbGRRQGRQFzddfVDLVhhfhddV
JwhLdLNLbwmJggCbbbhjHnDQNZWQWQjWZZPlHQ
GStzfBFzBMGMftpGcFFQDDjDQfZPfnnmDPfZZj
FqMBtFstpcTMBMSBGSBtqMhrwJLLTCbLhJbrhTCmrChv
WwWnTNVBNvWwBngdSqdRJJzncLSLpc
HPMZlGZQGtQjPdpqScpdjP
GltlGDDCMMplHCDphtbCHDwmWNBgVgvWhrmWssTBwWWV
clNNclslcLVWBNlGcVvdSHQvTMHZZSdsdQHM
gGhfpRwRZHMdJgZJ
fnDrpDtDrrWGcWVW
zdVzgdPSWRsHVzPsRRPHRHRRntnQrbDmfDfwfQwwZwfnbgMD
qNCJvjNLqjNhBBGjBvchhBCqffbffDGMnbwtfnbmQwQnZQMt
jccqJBvCjqvLTLJhJZpsPdSVdPszPRFssT
lDLvltDpvSpqGjVVMljGjW
zrdnswzcSzCgrdnBBjVcBBcjWTVTGb
PZgFdgHHnrdNDPvvtfNQSJ
GlLFbFNFtzcvddVpJVfGsCCC
PWhhMgWTTnhQrqMHTWqwddCVjSwQJddpBdQffp
WqJZDHPWgJrHnPqhnnqLbzzcLmbFDNmcbRzbbN
vtDcSfcWfmfTSGwvGDwTvFZVppsszCsVVVFjVzSVSM
NrrLPhdBRJLbPhrrRJwhBFZsFVzQzszsZzMCZjsJQF
glgwPqPhrRqPqBdNLwBrLRtnGHnDGmDqHWfGWfGcncHH
BtSfgpgvQhlSlwzZ
VHRmVzMPdPVRmcdhQwQwhClNNNCb
PcPMRWrVRRHTMDRVLPVzBnnJprjppBJtJftvpBfp
RpgBRVpLgBpDFCCPPVGvPSVVvb
dHrMdlWwwljjrlHrqmWjmWlGNvNSBBNhhSCSbSvNtNvQGd
TfmjqrwqHmqHrqlHwHpgfZFBzJgpZnpDcDBZ
NWTdFWlSMMMWTzVzdQfVpVDwwf
RHrrGrLqJLBqgpDgQfwfffHz
cssRRsBjvrGRjLBLrZcBvBqWPQNnlWTmSnjFllWMnCTFll
DCCDbHDhgbtCLHFHCQdQdSVfbNMdnfcSMS
ZZjPsqRZJlJlGZPTTqqRwJjZQVnMszVfzdSVScQQSQcNQNfM
mlGJJqmZjBZPhLBrgrWHFnDL
wLpCpDmmLwplgwVLwLwVgLLbWWJvJRTsRvbbJWCRsfbssv
FHHPFZnnhZQrqTTlSJRSrlfvrv
llZlPQFcZZHchjhjPqnjNFqNwggmDDwVNBBDwtpGMVDwDwVp
CctttjCrftNrBZpPgpgbNqdq
JhMwhMTGhMVhwDDMJJHGJJJBldWggWglddlbqlbPHbfqgf
DvJRMJVVJMTfJtnrnRjCSRFnrL
snDPGSQPnSSQQFwFFdzWFvmCVmmnjmCJjHjbZZhHZp
clgrgrMrRfqRlNggmhmHrhvVbpCjCVvV
fNgcBgqqLMqRqgLggtcTftBFdDFWQzDSQWPPGwWpwtGGsP
wSJWDCbwVdQfbffHfZZr
glgTBzzPSFhLFRvRQnZspZQpnvRp
qTLqglLNFqBqVMJqwwMVcS
rCWNCsrGrGGHrwQQHrfNDfvgLmmvMmLLMpmLvLPpPgww
djcdVdqJJcqqBstdBczbStThPPMPghvSpRgmlvghlmLpLp
qtjdBqzbTTtzTJTzVnbBdsNfDHZGGGDDnGfNDHDHFZFD
mlzzVHZmzvHflTJHqlJcZTvdcdCCPnddFGhPdBGhMFGCGc
QDRrWSprdqqCqDhF
NWtQNRrgWjpLjLsrRrQpfwVVqvwHzvvmVszlvlvm
DmDDtBDStSLcjLBDhhhmfnNFNlJJMFWFHSMWFpJNHp
PgMCgVgsCvVwRVRCwvgTzCMRWWwdnWHpNHFwWJJnHdHpprnp
RgZvvMbsbPCRGRTVPGmfBqDDqmthDQcmcZDc
WrfWpwwCwpdWCMBzqbtpjVbqzVqp
RvQQSFJNFZNNLPGbMMPqGtGPzF
DRvmNhZvJZmNmLcDZQcQNRfnnTMwrMHnfTrTCslsclCn
httbcnSsgtVMsnssnzghmmHvNmlHVLBHBLrVGGLN
QFpjZqpqWddZjjDWPWPwjFpfGLBfBBrrNLlBBgGrLCLmrfBB
QRjRjwjwDhbRTJnhgR
FTBTZqFVJnVTTPBTVmFbNjRffzrRrNQrPNQbzh
tCWwHMLCLDstlzdjwbzbQhRl
GvtChDChvtGSnZqnTVvBVF
spnFVspFPScprWrGvTpTWpvW
CgMqCqPLfqBBJGHlMrrJrWWl
ChjqhCtgdLPSQhQsRnVQ
bCQVZCJcrSSStrWTdhQqhzzMdhMz
lPDwNfgpDfBNgfnlDPRDpLWRhLbMjzWqMqWsMLLhLz
wpNPgPwwBDfvBnfgBfwglHDCJmtFGFmGSmCVrVCGbrCcFv
zNMJCHVJQmNLQFhZ
PPRPdGcRdPPjfjflqdjPDPTZQrhTFZFrmQZQBGZCFmLL
CcWfjjgWtjtMJWzVnSJVzJ
LjhDjVCVsjNfMsMQ
SdRpGSndZnlgpdSFtrQMtqNZJtwrMfQQ
cdRpcpnggRSmWpcLDHCCHfhBmPHTCV
zpmsJlptmfNwwFswGHThRcTqqHqhhWCWzh
SLgLMMgnPbSLPbPMDqZZcTWCnZWtRcWCZC
MbbvQtMVSLVrDMvSMSvSlwNsFNJspJFfNNmJrGGf
wvcQjfjQvQDJvwNwRdpRScCHbpdMbSpl
rfrZzrzWWmzlRpMMdpzd
LqrmFrVhFJjNfFfw
fVflVfmjQtZhzdrdlN
HwLLJvCcpcbRvDwpDvDCpqtTPPMNWTzTrHZTMPzPMPdH
LbvbJqgcqbpJLwvbbbmsmgVGmQmnjdSfSVjV
FngtfmfTTSFjFDnfjDbwnGzzGBGzbVRwVcwz
WWMrLLZLvZMWsrCcjzBGcpzLcGcVcB
NhMWllrsNZNrWZWhjCmmSmfgSTFDHTJfFSNq
lpqpqlhTSZqfZlwthPHsHcdHPhsCHLrP
zVDTjMgFbscczPbz
jRRmvmngNngqTZBqNlftTJ
wrMrJZPPrNZPZzhzMFPlDqSllsLSbWDWlWqNbb
VpGftgghtgQfVBgdnpBBngtWDSRbbSqltbRblDDDtqSlqS
gVggVgpVHTpmndffdVQVTVggjMwwjjMCjJFhPvZMwHvzMzjC
CtQPCFVlljWrNhTmCgLL
zsZbsnsqbMznDGNrrTqTLqWRHghN
zsMMGMSssSSzMGGMcvDGJFphFwPPvPvQfJppwQfj
njfVlRDDfDwHSfwVwSLnQZqGBbGsnZBnbGqZMbbpGG
zvddNNdWFgTPFgWNvNgcZqZbbqMMgBpsZrRZpgGG
CPchdcRTcNvvTWcmTNDSSfjwSDHCfQwlJLHl
LPmccvvFzzLvvQSzlFvFSSQDDtDfdDVdnDTBDsVTjDndlV
CbgNZWgZrbbqhrgTnVjjCsGdBfCfTs
BhwRrNrpQvLzvJSw
DpGFVsprFpTBJjsnJnnhdjWh
fbHCcbVHCgfMLwcqfLwgNdqhjRhnJQQdtQWnnSSJJj
gCZNVNzbHbfNHcHNgfCMLHHzPBDPvPDrlvDrDlvpmFTFBF
tsBQFgFpFBfsmtLjtgmtrQvCddSwSCwwbRvbwdLvwvRG
nqPZnMznTZHZlZPfGCHfbHwNVwdRwC
MPWqqzhZmBWFQfFW
FNMTTwqwNpVWPgZFFQ
crScdztJtcccSzWtzzzbStZQRZVVVHZVRgRQPHQhhjSZ
lCDCCdJJdbCdbcJzrcnrJWbnLLlvMMTLNwwMvfvwvMmNBNMG
WHsJMlBHCscDPDPtPBRDrL
jmTvgnqdsbPmSrrPVrwL
pdTgjgqbTqQFdjjQdqTZzCcJsZzQzcfsCCHMMl
QqMQGbMGGGzSsQSqCPcCPrCRNNlSZllc
vDHdmDWTdmwphhDdJwWvHdDCZPZVllPVRPRZNPVcZbTBZN
pmWHDmpmLgJvhvLpmvdvLWbsMgfsQGjqjtsnGfGqzGzzzQ
tFvMtFtFMvDDtMvLTpffQWWSGTsDTlSS
jqVnBjHqhPHbnhqPqWllfpfSTplQPQPGff
bbjHVHdjzqBznqVHBHzzqVFMJNMvmJtvtmcQFMZQFdJL
dcldCJQnldtTMdsccThhDDDDFhwTqDRwHR
ZbGzmgZSBpPPmmbNbZmgmNPPRqFzzVVhrwVHwRVHrVRHRRrR
bSSNmhPGWWZgQtLWtlCdJCMd
ttGBGNNgBgVBltlTJGJZpZlHSHCHfDSWpRWWpS
LhcLrcFFqdhLFLqvwMdhcPWpHHSSZWjjjCDwSSSfpWpD
fPMrqMMnqMFMbqcfnPMMBsgNttgggBmzJzbmGtbb
fjFhHHHmfjtLjrFmPhLbCdzBCpPCJQpJJGzJCp
RcDTnvlVqRnvnvRNcSzCJGJGCSJJCCdQqw
NTlMZVVlVVVlRTDTNjgGLfhrmgLFfZFGhr
GmbVGWttmpmbbqDWgVGGGtWNvNCCsHLLFsvHMHHLFnFn
wQQSdDTfSTsLCNnFwvFv
dPDBTBjzDftcBqBVbGBg
LmsfRLwCfZslcjljcjDjwN
gdRSrHHrSbdrggBzHBShHlqVvVDvcNvlcccjGlGjqB
zgTnSFFJdngddTZTPTWmspWQWWPR
RMZMtdsVCsRdddbsVcfcqgNfNDqGqGfzPzmf
BpwQrJvrjnSnQpBBBJCJjBBQlzvmDPzmDmglPzPgDNfNmNgz
LjLTnSpwjQTrnnLCBJLQjhstbMhsRtTdtMHMtbtsZd
PfrPHmrCRmRhcHCcmCfhhmWMLVpwVqFvvGGLVpQSwwSvSFFP
sJnjsgsDDdjjjdTglTgDBsBnSLdvwSqpQQbwQSLLLFSpQpbL
tBlngnqgqZggTZWfCRZmMCHHmM
LGGPQLDLPWmQLVdVdLLGbdvMNjfvHNFNNBbZnNMlHlBf
CshzsJBqTTwhttzCJzRtcNcMljnnnMjHlFnMcvnHfM
gqJsCwzBrQWDSgGmSS
FWVzVJjmbbJVpPwjjJDQsQNDgtcrWtddDQMg
TqRqCfGGBTzgTzDNNs
qRffnhhGvvvpwbvFzp
gLmMTpTCmRhgTLhCCZBSScJFQQQclWWMQJSJQW
rvfbDGjGssqbbrRSJJWclqcSwzwScc
PsDfGfVRjfTTTZNBPTZT
hWqrPzzMhrfmfdNtdZLNrnGndn
SwvwSFslbbjRsspQwsRwzcnbnNdTnZDbGctZdTNtNt
wvJJFsvpSSvJFjlHjzplQwJhCfVVhmBmVWhHWmWVWqBqMW
GjQtgjhPhGgsQjgtthrrvBlvljCrpCdlqBMb
RFDHDRFRczzlbqlbvqvHdb
DDFcRWTWFbSwRWbGtSGtgPfGGSPPtg
EOL;

echo score($input), PHP_EOL;
