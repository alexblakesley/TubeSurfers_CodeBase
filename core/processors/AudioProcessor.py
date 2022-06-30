import os
import numpy as np
from acoustics import Signal


### Variables to be adjusted ###
fileDirectory = ""
micGain = 34
### END ###


for filename in os.listdir(fileDirectory):
    # open wave file
    s = Signal.from_wav(os.path.join(fileDirectory, filename))

    nSamples = s.samples
    framerate = s.fs
    nChannels = s.channels

    # adjust mic gain
    s.gain(micGain)

    # A-weigh and get sound pressure levels
    spl_a = s.weigh('A').levels()

    # mean over all channels
    spl_mean = np.power(10,0.1*spl_a[1][0])
    for i in range(nChannels):
        spl_mean = meanTemp + np.power(10,0.1*spl_a[1][i])
    spl_mean = 10*np.log10(1/nChannels*spl_mean)

